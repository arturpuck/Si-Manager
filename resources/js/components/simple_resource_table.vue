<template>
  <table v-bind:data-transform-at="transformAtWidth" class="resource-table">
    <thead class="table-headers">
      <th class="resource-header" v-for="header in headers" v-bind:key="header">
        {{ header }}
      </th>
      <th v-bind:colspan="actionsColspan" class="resource-header">
        {{ translator.translate("actions") }}
      </th>
    </thead>
    <tbody>
      <tr
        class="resource-row"
        v-for="(resource, index) in resourceInstances"
        v-bind:key="index"
      >
        <td
          v-bind:data-aditional-header="header"
          class="resource-cell"
          v-for="header in headers"
          v-bind:key="header"
        >
          {{ resource[header] }}
        </td>
        <td
          v-on:click="emitEditEvent(resource)"
          class="resource-cell edit-cell"
        >
          <phantom-button class="action-button">{{
            translator.translate("edit")
          }}</phantom-button>
        </td>
        <td v-on:click="emitDeleteEvent(resource)" class="resource-cell delete-cell">
          <phantom-button class="action-button">{{
            translator.translate("delete")
          }}</phantom-button>
        </td>
        <td v-if="aditionalActionControlName" v-on:click="emitResourceSelectedbyAditionalAction(resource)" class="resource-cell aditional-cell">
          <phantom-button class="action-button">{{
            aditionalActionControlName
          }}</phantom-button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script lang="ts">
import PhantomButton from "@jscomponents-form-controls/phantom_button.vue";
import Translator from "@jsmodules/translator.js";

export default {
  name: "simple-resource-table",

  emits: ["edit", "delete", 'resourcesHaveChanged', 'aditionalActionSelected'],

  components: {
    PhantomButton,
  },

  props: {
    transformAtWidth: {
      required: false,
      default: "600px",
      type: String,
    },

    aditionalActionControlName : {
      required: false,
      default: "",
      type: String,
    }
  },

  data() {
    return {
      headers: [],
      resourceInstances: [],
      translator: Translator,
    };
  },

  computed : {
    actionsColspan() : number {
      return this.aditionalActionControlName ? 3 : 2;
    }
  },

  methods: {
    onUpdateTableHeaders(): void {
      this.emitter.on("updateResourceTableHeaders", this.updateTableHeaders);
    },

    onAddResource(): void {
      this.emitter.on("addNewResourcesToTable", this.addResource);
    },

    onUpdateResources(): void {
      this.emitter.on("updateExistingResourcesInTable", this.updateResources);
    },

    onDeleteResources(): void {
      this.emitter.on("removeResourcesFromTable", this.deleteResources);
    },

    onFlushTable(): void {
       this.emitter.on('flushResourcesTable', this.flushResourcesTable);
    },

    updateTableHeaders(headers: string[]): void {
      this.headers = headers;
    },

    deleteResources(deleteData: {
      deleteKey: string;
      deletedResourceIdentifiers: any[];
    }) : void {
       let resourcesWithDeletedItems = JSON.parse(JSON.stringify(this.resourceInstances));
       const {deleteKey, deletedResourceIdentifiers} = deleteData;

       deletedResourceIdentifiers.forEach(deletedIdentifier => {
            resourcesWithDeletedItems = resourcesWithDeletedItems.filter(resourceFromList => resourceFromList[deleteKey] != deletedIdentifier)
       });
       this.resourceInstances = resourcesWithDeletedItems;
       this.resourcesHaveChanged();
    },

    updateResources(updateData: {
      updatedResources: object[];
      replacementKey: string;
    }) {
      let resourcesForMapping = JSON.parse(JSON.stringify(this.resourceInstances));
      let { updatedResources, replacementKey } = (updateData = updateData);

      updatedResources.forEach((updatedResource) => {
        resourcesForMapping = resourcesForMapping.map(
          (resourceExistingOnList) =>
            resourceExistingOnList[replacementKey] ===
            updatedResource[replacementKey]
              ? updatedResource
              : resourceExistingOnList
        );
      });
      this.resourceInstances = resourcesForMapping;
      this.resourcesHaveChanged();
    },

    emitResourceSelectedbyAditionalAction(resource) : void {
        this.$emit('aditionalActionSelected', resource);
    },

    emitEditEvent(resource): void {
      this.$emit("edit", resource);
    },

    resourcesHaveChanged() : void {
        this.$emit('resourcesHaveChanged', this.resourceInstances);
    },

    emitDeleteEvent(resource): void {
      this.$emit("delete", resource);
    },

    addResource(resource): void {
      if (Array.isArray(resource)) {
        this.resourceInstances = this.resourceInstances.concat(resource);
      } else {
        this.resourceInstances.push(resource);
      }
      this.resourcesHaveChanged();
    },

    flushResourcesTable() : void {
      this.resourceInstances = [];
      this.resourcesHaveChanged();
    },

    registerListeningToEvents() : void {
       this.onUpdateTableHeaders();
       this.onAddResource();
       this.onUpdateResources();
       this.onDeleteResources();
       this.onFlushTable();
    }
  },

  created() {
      this.registerListeningToEvents();
  },
};
</script>

<style lang="scss" scoped>
@import "~sass/fonts";

@mixin table-border {
  border: 1px solid white;
}

.resource-table {
  margin: 0 auto;
  @include responsive-font(1.2vw, 13px);
  @include table-border();
}

.resource-header {
  text-align: center;
  @include responsive-font(1.3vw, 15px);
  color: white;
  padding: 5px;
  background: #0e621d;
  @include table-border();
}

.resource-cell {
  @include table-border();
  color: white;
  padding: 4px 3px;
}

.resource-row {
  cursor: pointer;
  &:nth-of-type(even) {
    background: black;
  }

  &:nth-of-type(odd) {
    background: #3a3a3a;
  }

  &:hover {
    background: #0f990f;
  }
}

.delete-cell {
  &:hover {
    background: red;
  }
}

.aditional-cell {
  &:hover {
    background: rgb(214, 214, 8);
  }
}

.edit-cell {
  &:hover {
    background: dodgerblue;
  }
}

@media screen and (max-width: 800px) {
  .table-headers {
    display: none;
  }

  .resource-cell {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    &::before {
      content: attr(data-aditional-header) " : ";
      color: #ad0b41;
    }
  }

  .action-button {
    flex-grow: 100;
  }
}
</style>