/*************************************************************************
 * ADOBE CONFIDENTIAL
 * ___________________
 *
 *  Copyright 2015 Adobe Systems Incorporated
 *  All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Adobe Systems Incorporated and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Adobe Systems Incorporated and its
 * suppliers and are protected by all applicable intellectual property
 * laws, including trade secret and copyright laws.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Adobe Systems Incorporated.
 **************************************************************************/
define(['home/view/update/entity',
  'home/constants',
  'jquery',
  'home/utils/sendMessage',
  'underscore',
  'home/singleton/collection/AppUpdate',
  'home/singleton/view/update_request',
  'home/utils/truncateText',
  'home/config',
  'home/singleton/Main',
  'home/utils/utils',
  'interface/events'
], function(Entity, K, $, sendMessage, _, AppCol, UpdateRequest, truncateText, config, Home, homeUtils, Events) {
  "use strict";

  return Entity.extend({

    truncate_direction: K.TRUNCATE_DIRECTION_H,

    container_selector: '.home_app_updates.container',

    events: {
      "click .single_container .ur_detail a.detailText": "sendClickEvent",
      "click .single_container .bug_notes a.close": "sendClickEvent",
      "click .single_container .action a": "sendClickEvent",
      "click .single_container .progressing .btnCancel": "sendClickEvent",
      "click .single_container .action .error": "sendClickEvent"
    },

    initialize: function() {

      // TODO: Why is this binding all functions to context? Should probably only need a few
      _.bindAll(this, 'render', 'updateView', 'selectTemplate', 'renderFromTop', 'renderAtBottom', 'removeNotification', 'completeNotification', 'toggleReleaseNotes');

    },

    updateView: function() {
      var m = this.model;
      var notif_state = m.get("state");

      if (m.get("restartRequiredString") != "-1") {
        this.$el.find(".restartRequired").html(m.get("restartRequiredString"));
        this.$el.find(".restartRequired").show();
      }
      else
        this.$el.find(".restartRequired").hide();

      //this.render(false,"update"); // adding for #3563256
      //this.$el.findhtml(this.template({config:config}));

      if (m.get("errorText") != "-1") {
        this.$el.find(".single_container .action.col").children().hide();
        this.$el.find(".single_container .action .error").html(m.get("errorText"));
        this.$el.find(".single_container .action .error").show();

      }

      else if (m.get("progressText") != "-1" && notif_state === K.STATE_NEW) {
        this.$el.find(".single_container .action.col").children().hide();
        this.$el.find(".percent").html(m.get("progressText"));
        this.$el.find(".single_container .action .progressing").show();

        if (m.get("progressPercentage") != "-1") {
          this.$el.find(".progress-meter-container").css("display","inline-block");
          this.$el.find(".progress-meter").width(m.get("progressPercentage") + "%");
        }
        else
          this.$el.find(".progress-meter-container").hide();

        this.$el.find(".btnCancel")[m.get("isCanceledEnabled")]();
      }

      else if (m.get("state") === K.STATE_NEW) {
        this.$el.find(".single_container .action.col").children().hide();
        this.$el.find(".single_container .action .default").show();
      }

      if (m.hasChanged("state")) {
        switch (notif_state) {
          case K.STATE_REMOVE:
            this.removeNotification();
            break;
          case K.STATE_COMPLETE:
          {
            this.completeNotification();
            m.set("isComplete", true);
            break;
          }
          case K.STATE_EXPIRED:
          {
            var isCompleteState = m.get("isComplete");
            if (isCompleteState === false)
              this.removeNotification();
            else {
              this.completeNotification();
              this.$el.find(".info .detailText").html(m.get("releaseNotesString"));
              this.$el.find(".info .detailText").attr("id", "17");
              this.$el.find(".bug_notes").slideUp();
            }
            break;
          }
        }
      }

      if (m.hasChanged("releaseNotesString"))
        this.$el.find(".info .detailText").html(m.get("releaseNotesString"));
    },

    sendClickEvent: function(event) {
      event.stopImmediatePropagation();

      if ($(event.target).hasClass("btn") || $(event.target).hasClass("negative")) {


        if ($(event.target).hasClass("btn")) {
          $(".single_container .action.col", this.el).children().hide();
          $(".single_container .action .pending", this.el).show();

        }
        else {
          this.model.set({state: K.STATE_REMOVE});
        }
      }
      else if (this.model.get("state") != K.STATE_EXPIRED && ($(event.target).hasClass("detailText") || $(event.target).hasClass("close"))) {
        if (this.model.get("updateType") === K.UPDATE_TYPE_APP_UPDATE) {
        }
        else {
          this.toggleReleaseNotes($(".single_container .bug_notes", this.el));
        }
      }

      /* var respMsg =
       K.RESP_ACTION_MESSAGE_TAG_OPEN +
       K.RESP_ID_TAG_OPEN + this.model.get('id') + K.RESP_ID_TAG_CLOSE +
       K.RESP_ACTION_TYPE_TAG_OPEN + K.EVENT_CLICK +  K.RESP_ACTION_TYPE_TAG_CLOSE +
       K.RESP_ITEM_INDEX_TAG_OPEN + ($(event.target).attr("id")=== undefined ? 0 : $(event.target).attr("id"))  + K.RESP_ITEM_INDEX_TAG_CLOSE+
       K.RESP_ACTION_MESSAGE_TAG_CLOSE; */

      var msg = {
        "command": homeUtils.shared.createMessage(Home.entity.get('header'), K.ACTION_UR_CLICKED, true)
      };
      msg.command.xmlData.xmldata[K.TAG_ACTION_MESSAGE] = {};
      msg.command.xmlData.xmldata[K.TAG_ACTION_MESSAGE].id = this.model.get('id');
      msg.command.xmlData.xmldata[K.TAG_ACTION_MESSAGE].actionType = K.EVENT_CLICK;
      msg.command.xmlData.xmldata[K.TAG_ACTION_MESSAGE].itemIndex = ($(event.target).attr("id") === undefined ? 0 : $(event.target).attr("id"));

      Events.trigger(K.EVT_SEND_MESSAGE, {action: K.ACTION_UR_CLICKED, msg: msg});

      // sendMessage(K.ACTION_UR_CLICKED, respMsg);

    },

    removeNotification: function() {
      try {
        var self = this;
		_.defer(function(){   
		$(self.el).remove();
		AppCol.remove(self.model);
		},100);

        //This is a temporary workaround to tackle refresh issues
       // $("body").css("opacity", 0.9);
       // $("body").animate({opacity: 1}, 50);
      }
      catch (e) {
      }
    },

    completeNotification: function() {
      $(".single_container .action.col", this.el).children().hide();
      $(".single_container .action .complete", this.el).show();

      UpdateRequest.updateView();
    },

    toggleReleaseNotes: function(selector) {
      if (selector.is(":visible")) {
        selector.stop(true, true).fadeOut({duration: 250, queue: false}).slideUp(250);
        $(".single_container .ur_detail a.detailText", this.el).html(this.model.get("releaseNotesString"));
        $(".single_container .ur_detail a.detailText", this.el).attr("id", "16");
      }
      else {
        selector.stop(true, true).fadeIn({duration: 250, queue: false}).css('display', 'none').slideDown(250);
        $(".single_container .ur_detail a.detailText", this.el).html(this.model.get("closeString"));
        $(".single_container .ur_detail a.detailText", this.el).attr("id", "15");
      }
    },

    selectTemplate: function(notif_subtype) {

      var template_wrapper_open =
          '<div class="single_container">' +
          '<div class="row">' +
          '<div class="avatar col">' +
          '<img class="avatar-image" src="<%=this.model.get(\"avatarIcon\")%>" />' +
          '</div>' +
          '<div class="ur_detail col">' +
          '<div class="detail">',

        template_wrapper_close =
          '</div>' +
          '</div>' +
          '<div class="action col">' +
          '<div class="default">' +
          '<a class="negative secondary_link" id="0"><%=this.model.get("negativeItem")%></a>' +
          '<a class="btn small" id="1"><%=this.model.get("positiveItem")%></a>' +
          '</div>' +

          '<div class="progressing">' +
          '<span class="percent"><%= this.model.get("progressText") %></span>' +

          '<div class="progress-meter-container"><div class="progress-meter"></div></div>' +
          '<a class="btnCancel sprite sprite-download-cancel" id="3"></a>' +

          '</div>' +

//                        '<div class="pending secondary_text"><%= this.model.get("pendingString") %></div>' +

          '<div class="error home_pointer" id="12"><%= this.model.get("errorText") %></div>' +

          '<div class="complete">' +
          '<div class="success sprite sprite-notification-checkmark"></div>' +
          '<span class="completionText secondary_text"><%= config.HEADER_UP_TO_DATE %></span>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '<div class="bug_notes">' +
          '<div class="bug_notes_inner">' +
          '<a id="16" class="close sprite sprite-update-box-close"></a>' +
          '<ul class="notes">' +
          '<% for(j=0; arrNotes !== undefined && j<arrNotes.length ; j++) {%>' +
          '<li><%=arrNotes[j]%></li>' +
          '<%}%>' +
          '</ul>' +
          '</div>' +
          '</div>' +
          '</div>',

        app_update_available;

      switch (notif_subtype) {

        case K.NOTIF_SUBTYPE_UPDATE_AVAILABLE_NOTIFICATIONS:

          app_update_available = _.template(
            template_wrapper_open +
            '<div class="msg appName"><%=this.model.get("msgHTML")%></div>' +
            '<div class="info secondary_text">' +
            '<% if((arrNotes !== undefined && arrNotes.length > 0) || (this.model.get("updateType"))){%>' +
            '<a class="detailText secondary_link" id="15"><%=this.model.get("releaseNotesString")%></a>' +
            '<%}%>' +
            '&nbsp; <span class="restartRequired"><%=this.model.get("restartRequiredString")%></span>' +
            '</div>' +
            template_wrapper_close
          );

          this.template = app_update_available;
          break;
      }
    }
  });
});

