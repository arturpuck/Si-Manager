<template>
  <section
    v-bind:class="{ nested: isNested, notNested: !isNested }"
    class="comment-container"
  >
    <div class="actuall-comment">
      <div class="user-data">
        <user-preview
          v-bind:user-nickname="userNickname"
          v-bind:authenticated-user="addedByAuthenticatedUser"
          v-bind:avatar-file-path="avatarFilePath"
        >
        </user-preview>
        <div class="date-conatiner">
          <date-confirmed-icon
            class="date-confirmed-icon"
          ></date-confirmed-icon>
          <span v-text="addedAgo" class="added-ago"></span>
        </div>
      </div>
      <pre v-text="commentBody" class="comment-text"></pre>
    </div>
    <div class="sub-comments-section">
      <phantom-button
        v-on:click="toggleResponseCommentBox"
        v-show="!inResponseMode"
        class="answear-comment-button"
        >{{ Translator.translate("answear_comment") }}</phantom-button
      >
      <phantom-button
        v-bind:title="answearsLabel"
        v-on:click="showChildComments"
        v-if="showChildCommentsInfo"
        class="show-child-comments-button"
        >{{ childCommentsCaption }}</phantom-button
      >
    </div>

    <comment-box
      v-if="inResponseMode"
      v-bind:user-nickname="userNickname"
      v-bind:avatar-file-path="avatarFilePath"
      v-bind:nesting-level="childrenNestingLevel"
      v-bind:comment-id="id"
      v-on:added-comment="toggleResponseCommentBox"
      v-bind:parent-comment-id="passedToOffspringParentCommentId"
      v-on:close-me="closeCommentBox"
    >
    </comment-box>
    <comment-body
      v-bind:key="childComment.id"
      v-for="childComment in childComments"
      v-bind:id="childComment.id"
      v-bind:comment-body="childComment.body"
      v-bind:added-by-authenticated-user="childComment.addedByAuthenticatedUser"
      v-bind:avatar-file-path="childComment.avatarFilePath"
      v-bind:added-ago="childComment.addedAgo"
      v-bind:user-nickname="childComment.userNickname"
      v-bind:number-of-child-comments="childComment.numberOfChildComments"
      v-bind:nesting-level="childrenNestingLevel"
      v-bind:parent-comment-id="passedToOffspringParentCommentId"
    ></comment-body>
  </section>
</template>

<script lang="ts">
import Translator from "@jsmodules/translator.js";
import UserPreview from "@jscomponents/user/user_preview.vue";
import DateConfirmedIcon from "@svgicon/date_confirmed_icon";
import PhantomButton from "@jscomponents/form_controls/phantom_button.vue";
import CommentBox from "@jscomponents-form-controls/comment_box.vue";
import Comment from "@interfaces/Comment";
import CommentBody from "@jscomponents/form_controls/comment_body.vue";
import PageListUpdate from "@interfaces/PageListUpdate";

export default {
  name: "comment-body",

  provide() {
    return {
      avatarFilePath: this.avatarFilePath,
    };
  },

  data() {
    return {
      Translator,
      inResponseMode: false,
      currentChildCommentsPage: 0,
      childCommentsPerPage: 5,
      childComments: [],
      numberOfVisibleChildComments: 0,
      variableNumberOfChildComments : 0
    };
  },

  methods: {
    toggleResponseCommentBox() {
      this.inResponseMode = !this.inResponseMode;
    },

    closeCommentBox() : void {
      this.inResponseMode = false;
    },

    showChildComments(): void {
      if (this.anyChildCommentsCanBeFetched) {
        ++this.currentChildCommentsPage;
        this.emitter.emit("showCommentAnswears", [
          this.id,
          this.currentChildCommentsPage,
          this.childCommentsPerPage,
        ]);
      }
    },

    displayChildComments(receivedUpdate: PageListUpdate<Comment> | Comment): void {
      let commentsRefreshed;

      if("totalElements" in receivedUpdate && "currentPage" in receivedUpdate) {
        commentsRefreshed = [
         ...this.childComments,
         ...receivedUpdate.content,
       ];
      }
      else { 
        commentsRefreshed = [
         ...this.childComments,
         receivedUpdate
       ];
       ++this.variableNumberOfChildComments;
      }
      commentsRefreshed = commentsRefreshed.sort(
        (commentA: Comment, commentB: Comment) =>
          new Date(commentA.createdAt).getTime() -
          new Date(commentB.createdAt).getTime()
      );
      
      commentsRefreshed = Array.from(new Map(commentsRefreshed.map(comment => [comment.id, comment])).values());
      this.numberOfVisibleChildComments = commentsRefreshed.length;
      this.childComments = commentsRefreshed;
    },
  },

  mounted() {
    this.emitter.on(
      `childCommentsReceived${this.id}`,
      this.displayChildComments
    );
  },

  created(){
    this.variableNumberOfChildComments = this.numberOfChildComments;
  },

  computed: {

    anyChildCommentsCanBeFetched(): boolean {
      return this.childCommentsRemaining > 0;
    },

    childCommentsRemaining(): number {
      return this.variableNumberOfChildComments - this.numberOfVisibleChildComments;
    },

    isNested(): boolean {
      return this.nestingLevel > 0;
    },

    childrenNestingLevel(): number {
      return this.nestingLevel in [0, 1] ? this.nestingLevel + 1 : 2;
    },

    showChildCommentsInfo(): boolean {
      return (
        this.variableNumberOfChildComments > 0 &&
        (this.variableNumberOfChildComments != this.numberOfVisibleChildComments)
      );
    },

    childCommentsCaption(): string {
      return `${Translator.translate("answears")} (${
        this.childCommentsRemaining
      })`;
    },

    passedToOffspringParentCommentId(): number {
      return this.nestingLevel in [0, 1] ? this.id : this.parentCommentId;
    },

    answearsLabel() : string {
      return Translator.translate('show_next_answears');
    }
  },

  components: {
    UserPreview,
    DateConfirmedIcon,
    CommentBox,
    PhantomButton,
    CommentBody,
  },

  props: {
    id: {
      required: true,
      type: Number,
    },

    avatarFilePath: {
      type: String,
      required: true,
      default: "",
    },

    addedByAuthenticatedUser: {
      type: Boolean,
      required: false,
      default: false,
    },

    userNickname: {
      type: String,
      required: true,
    },

    commentBody: {
      type: String,
      required: true,
    },

    addedAgo: {
      type: String,
      required: true,
    },

    nestingLevel: {
      type: Number,
      required: false,
      default: 0,
    },

    numberOfChildComments: {
      required: false,
      type: Number,
      default: 0,
    },

    parentCommentId: {
      required: false,
      type: Number,
      default: 0,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/fonts";
@import "~sass/responsive_icon";

.nested {
  margin: 20px 0 20px auto;
}

.notNested {
  margin: 20px auto;
}

.show-child-comments-button {
  @include responsive-font();
  color: white;
  &:hover {
    color: #e50c33;
  }
}

.actuall-comment {
  border: 1px solid gray;
  border-radius: 1vw;
}

.added-ago {
  @include responsive-font();
  width: max-content;
  color: white;
}

.date-conatiner {
  display: flex;
  padding: 4px;
  @media (max-width: 500px) {
    padding: 4px 4px 4px 10px;
  }
}

.date-icon {
  margin: 0 4px;
  color: white;
  @include responsive-font(1.3vw, 16px, "");
}

.user-data {
  padding: 0.5vw;
  display: flex;
  border-radius: 1vw 1vw 0 0;
  align-items: center;
  background: #252222;
  justify-content: space-between;
  @media (max-width: 640px) {
    flex-direction: column;
    align-items: flex-start;
  }
}

.comment-text {
  @include responsive-font();
  padding: 1vw;
  background: black;
  color: white;
  border-radius: 0 0 1vw 1vw;
  margin:0;
}

.comment-container {
  border-radius: 1vw;
  position: relative;
  width: 95%;
  max-width:1000px;
  min-width:250px;
}

.date-confirmed-icon {
  width: 1.4em;
  height: 1.4em;
}

.sub-comments-section {
  display: flex;
  justify-content: space-between;
}

.answear-comment-button {
  width: 10%;
  min-width: 100px;
  display: inline-block;
  margin: 0 0 0 10px;
  color: white;
  @include responsive-font();
  &:hover {
    color: #e50c33;
  }
  &:active {
    transform: scale(1.1);
  }
}
</style>
