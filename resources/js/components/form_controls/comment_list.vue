<template>
  <div>
    <show-comment-form-button
      v-show="!commentFormIsVisible"
      v-on:click="showCommentForm"
      class="comment-form-button"
    ></show-comment-form-button>
    <comment-box
      v-show="commentFormIsVisible"
      v-bind:authenticated-user="authenticatedUser"
      v-bind:avatar-file-path="currentUserAvatarFilePath"
      v-bind:user-nickname="userNickname"
      v-on:close-me="hideCommentForm"
    ></comment-box>
    <pages-list v-bind:unique-identifier="uniqueIdentifier"></pages-list>
    <div
      v-show="!anyCommentsAvailable"
      v-text="translations['no_comments']"
      class="no-comments-info"
    ></div>
    <div class="comments-list">
      <comment-body
        v-for="comment in comments"
        v-bind:key="comment.id"
        v-bind:id="comment.id"
        v-bind:comment-body="comment.body"
        v-bind:added-by-authenticated-user="comment.addedByAuthenticatedUser"
        v-bind:avatar-file-path="comment.avatarFilePath"
        v-bind:added-ago="comment.addedAgo"
        v-bind:user-nickname="comment.userNickname"
        v-bind:number-of-child-comments="comment.numberOfChildComments"
      >
      </comment-body>
    </div>
    <pages-list v-bind:unique-identifier="uniqueIdentifier"></pages-list>
  </div>
</template>

<script lang="ts">
import CommentBody from "@jscomponents/form_controls/comment_body.vue";
import Comment from "@interfaces/Comment";
import PageListUpdate from "@interfaces/PageListUpdate";
import PagesListBasicData from "@interfaces/pages_list_basic_data";
import PagesList from "@jscomponents/pages_list.vue";
import Translations from "@jsmodules/translations/comments_list";
import ShowCommentFormButton from "@jscomponents/form_controls/show_comment_form_button.vue";
import CommentBox from "@jscomponents/form_controls/comment_box.vue";

export default {
  name: "comment-list",

  provide() {
     return {
       currentUserIsAuthenticated : this.authenticatedUser,
       currentUserNickname : this.userNickname,
       currentUserAvatarFilePath : this.currentUserAvatarFilePath,
     };
  },

  props: {
    initialComments: {
      type: Array,
      required: false,
      default: () => [],
    },

    authenticatedUser: {
      type: Boolean,
      required: false,
      default: false,
    },

    userNickname: {
      type: String,
      required: false,
      default: "",
    },

    currentUserAvatarFilePath : {
      type: String,
      required: false,
      default: "",
    },

    initialCommentsPerPage: {
      type: Number,
      required: false,
      default: 10,
    },

    uniqueIdentifier: {
      type: String,
      required: false,
      default: "",
    },
  },

  components: {
    CommentBody,
    Comment,
    PagesList,
    ShowCommentFormButton,
    CommentBox,
  },

  data() {
    return {
      comments: [],
      commentFormIsVisible: false,
      translations: Translations,
      commentsPerPage: 10,
      totalCommentsAvailable: 0,
    };
  },

  methods: {
    updateComments(commentsUpdate: PageListUpdate<Comment> | Comment): void {
      if("content" in commentsUpdate && "totalElements" in commentsUpdate){ 
        this.comments = commentsUpdate.content;
        this.totalCommentsAvailable = commentsUpdate.totalElements;
        
        this.updatePagesList({
           totalElements: this.totalCommentsAvailable,
           currentPage : commentsUpdate.currentPage
        });
      }
      else {
        this.comments = [commentsUpdate, ...this.comments];
        ++this.totalCommentsAvailable;
      }
    },

    updatePagesList(commentsUpdate: PageListUpdate<Comment>): void {
      const pagesNumber = this.calculateSubPagesNumber(
        commentsUpdate.totalElements,
        this.commentsPerPage
      );

      const pagesListStatus: PagesListBasicData = {
        pagesNumber,
        currentPage: commentsUpdate.currentPage,
      };
      //@ts-ignore
      this.emitter.emit(
        `updatePagesList${this.uniqueIdentifier}`,
        pagesListStatus
      );
    },

    calculateSubPagesNumber(
      totalComments: number,
      commentsPerPage: number
    ): number {
      return Math.ceil(totalComments / commentsPerPage);
    },

    showCommentForm(): void {
      this.commentFormIsVisible = true;
    },

    hideCommentForm(): void {
       this.commentFormIsVisible = false;
    },

    closeCommentForm(): void {
      this.commentFormIsVisible = false;
    }
  },

  mounted() {
    this.comments = this.initialComments;
    //@ts-ignore
    this.emitter.on("updateComments", this.updateComments);
    this.emitter.on('hideCommentForm', this.hideCommentForm);
    this.commentsPerPage = this.initialCommentsPerPage;
  },

  computed: {
    anyCommentsAvailable(): boolean {
      return this.totalCommentsAvailable > 0;
    },

    availableCommentsInformation(): string {
      return this.anyCommentsAvailable
        ? `${this.translations["total_comments"]} : ${this.totalCommentsAvailable}`
        : this.translations["no_comments_available"];
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/fonts";

.comment-form-button {
  margin: 4px auto;
}

.no-comments-info {
  @include responsive-font();
  text-align: center;
  color: white;
  padding: 5px;
}

.comments-list {
  padding: 0;
  margin: 0;
}
</style>
