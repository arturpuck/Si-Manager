<template>
  <section v-bind:class="nestingClassObject" class="container">
    <div class="main-comment">
      <div v-if="currentUserIsAuthenticated" class="user-nickname-label">
        <Avatar
          v-bind:superior-avatar-file-path="currentUserAvatarFilePath"
        ></Avatar>
        <label class="blank-label">
          <span v-text="placeholderText" class="comment-description"></span>
          <textarea
            v-on:paste="processUserComment"
            v-bind:style="{ height: textAreaHeightCSS, padding: paddingCSS }"
            v-bind:placeholder="placeholderText"
            ref="comment_textarea"
            v-on:input="processUserComment"
            v-on:blur="emitCommentText"
            v-model="userComment"
            class="comment-body"
            rows="1"
          ></textarea>
        </label>
      </div>
      <div
        class="unauthenticated-user-controls"
        v-if="!currentUserIsAuthenticated"
      >
        <label class="user-nickname-label">
          <span
            v-text="userNicknameDescription"
            class="unuser-nickname-description"
          ></span>
          <input
            v-on:input="emitUserNickName"
            v-on:blur="emitUserNickName"
            v-model="unauthenticatedUserNickName"
            v-bind:placeholder="unauthenticatedUserNickNamePlaceholder"
            type="text"
            class="unauthenticated-user-nickname"
          />
        </label>
        <textarea
          v-on:paste="processUserComment"
          v-bind:style="{ height: textAreaHeightCSS, padding: paddingCSS }"
          v-bind:placeholder="placeholderText"
          ref="comment_textarea"
          v-on:input="processUserComment"
          v-on:blur="emitCommentText"
          v-model="userComment"
          class="comment-body"
          rows="1"
        ></textarea>
      </div>
    </div>
    <section class="action-controls">
    <add-button
      class="add-comment-button"
      v-on:click="saveComment"
    ></add-button>
    <button-close v-on:click="emitCloseEvent"></button-close>
    </section>
  </section>
</template>

<script lang="ts">
import Translator from "@jsmodules/translator.js";
import UserPreview from "@jscomponents/user/user_preview.vue";
import AvatarIcon from "@svgicon/avatar_icon.vue";
import Comment from "@interfaces/Comment";
import AddPlusIcon from "@svgicon/add_plus_icon.vue";
import Avatar from "@jscomponents/user/avatar.vue";
import AddButton from "@jscomponents-form-controls/add_button.vue";
import ButtonClose from "@jscomponents/form_controls/button_close.vue";

export default {
  name: "comment-box",

  emits: ["addedComment", "commentInput", "closeMe"],

  props: {
    userNickname: {
      type: String,
      required: false,
      default: "",
    },

    nestingLevel: {
      type: Number,
      required: false,
      default: 0,
    },

    parentCommentId: {
      required: false,
      type: Number,
      default: undefined,
    },
  },

  components: {
    UserPreview,
    AvatarIcon,
    AddPlusIcon,
    Avatar,
    AddButton,
    ButtonClose
  },

  data() {
    return {
      translator: Translator,
      unauthenticatedUserNickName: "",
      userComment: "",
      textAreaHeightCSS: "",
      paddingCSS: "2px",
    };
  },

  inject: [
    "currentUserIsAuthenticated",
    "currentUserNickname",
    "currentUserAvatarFilePath",
  ],

  computed: {
    userNicknameDescription(): string {
      return `${this.translator.translate("nickname")} :`;
    },

    nestingClassObject(): object {
      return {
        nested: this.nestingLevel > 0,
      };
    },

    placeholderText(): string {
      return this.translator.translate("comment_text");
    },

    unauthenticatedUserNickNamePlaceholder(): string {
      return this.translator.translate("nickname");
    },
  },

  methods: {
    emitCloseEvent(){
       this.$emit("closeMe");
    },

    emitUserNickName(): void {
      this.$emit("nicknameInput", this.unauthenticatedUserNickName);
    },

    getCommentContentHeight() {
      return this.$refs.comment_textarea.scrollHeight;
    },

    processUserComment() {
      this.$emit("commentInput", this.userComment);

      setTimeout(() => {
        this.textAreaHeightCSS = "auto";
        this.paddingCSS = "0";
        this.paddingCSS = "2px";
        this.textAreaHeightCSS = `${this.getCommentContentHeight()}px`;
      }, 0);
    },

    emitCommentText() {
      this.$emit("commentInput", this.userComment);
    },

    saveComment() {
      const commentData: Comment = {
        userNickname: this.unauthenticatedUserNickName,
        body: this.userComment,
        addedByAuthenticatedUser: this.currentUserIsAuthenticated,
      };

      if (this.parentCommentId > 0) {
        commentData["parentCommentID"] = this.parentCommentId;
      }

      this.emitter.emit("saveComment", commentData);
      this.resetCommentBox();
      this.$emit("addedComment");
    },

    resetCommentBox() {
      this.userComment = "";
      this.unauthenticatedUserNickName = "";
    },

    created() {
      this.translator = Translator;
      //@ts-ignore
      this.emitter.on("resetCommentBox", this.resetCommentBox);
    },
  },

  mounted() {
    this.textAreaHeightCSS = "calc(1.4em + 6px)";
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/fonts";
@import "~sass/responsive_icon";

.action-controls {
  margin:0;
  padding:0;
  display: flex;
  align-items: center;
}

.add-comment-button {
  margin: 6px 6px 6px 0;
}

.unauthenticated-user-controls {
  background: black;
  display: flex;
  flex-direction: column;
}

.empty-avatar-decoration {
  @include responsive-font(1.3vw, 16px, "");
  color: crimson;
  margin: 0 5px;
}

.authenticated-user-nickname {
  white-space: nowrap;
  overflow: hidden;
  flex-grow: 100;
  @include responsive-font(1.3vw, 16px);
  color: white;
}

.user-avatar {
  width: 1.8vw;
  height: 1.8vw;
  margin: 0 4px;
  border-radius: 2px;
  border-radius: 30%;
  @media (max-width: 1200px) {
    width: 30px;
    height: 30px;
  }
}

.blank-label {
  border: none;
  outline: none;
  background: transparent;
  padding: 0;
  margin: 0;
  flex-grow: 100;
  display: flex;
}

.comment-description {
  position: absolute;
  top: -9999px;
  left: 0;
  font-size: 2px;
}

.unauthenticated-user-nickname {
  @include responsive-font(1.3vw, 16px);
  flex-basis: 1%;
  background: #212120;
  border-radius: 0.5vw;
  border: 1px solid transparent;
  color: white;
  flex-grow: 100;
  outline: none;
  min-width: 0;
  &:focus {
    border: 1px solid #cb425f;
  }
}

.unauthenticated-user-nickname-description {
  @include responsive-font(1.3vw, 16px);
  line-height: 1.5em;
  padding-right: 7px;
  white-space: nowrap;
}

.container {
  font-size: 0;
  width: 40vw;
  min-width: 270px;
  margin: 10px auto;
}

.main-comment {
  border: 1px solid gray;
  border-radius: 1vw;
  overflow: hidden;
}

.nested {
  margin: 7px 0 0 auto;
  width: 90%;
}

.user-nickname-label {
  display: flex;
  flex-wrap: nowrap;
  align-items: center;
  background: black;
  color: white;
  padding: 8px;
  flex-grow: 100;
}

.nickname-decoration {
  @include responsive-icon(0 5px, 2.3vw, 28px);
  fill: white;
}

.comment-body {
  flex-grow: 100;
  margin: 4px;
  background: #212120;
  border-radius: 0.5vw;
  line-height: 1.4em;
  border: 1px solid transparent;
  outline: none;
  resize: none;
  overflow: hidden;
  color: white;
  @include responsive-font(1.3vw, 16px);
  &:focus {
    border: 1px solid #cb425f;
  }
}
</style>
