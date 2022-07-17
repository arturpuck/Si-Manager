<template>
  <table v-bind:data-transform-at="transformAtWidth" class="resource-table">
    <thead class="table-headers">
      <th class="resource-header" v-for="header in headers" v-bind:key="header">{{header}}</th>
      <th colspan="2" class="resource-header">{{translator.translate('actions')}}</th>
    </thead>
    <tbody>
      <tr class="resource-row" v-for="(resource, index) in resourceInstances" v-bind:key="index">
        <td v-bind:data-aditional-header="header" class="resource-cell" v-for="header in headers" v-bind:key="header">{{resource[header]}}</td>
        <td v-on:click="emitEditEvent(resource)" class="resource-cell edit-cell">
          <phantom-button class="action-button">{{translator.translate('edit')}}</phantom-button>
        </td>
        <td class="resource-cell delete-cell">
          <phantom-button class="action-button">{{translator.translate('delete')}}</phantom-button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script lang="ts">
import PhantomButton from "@jscomponents-form-controls/phantom_button.vue";
import Translator from "@jsmodules/translator.js"

export default {
   name : 'simple-resource-table',

   emits : [
     'edit'
   ],

   components : {
    PhantomButton
   },

   props : {
      transformAtWidth : {
        required : false,
        default : '600px',
        type : String
      }
   },

   data() {
    return { 
       headers : [],
       resourceInstances : [],
       translator: Translator,
    };
   },

   methods : {
      onUpdateTableHeaders() : void {
        this.emitter.on('updateResourceTableHeaders', this.updateTableHeaders);
      },

      onAddResource() : void {
          this.emitter.on('addNewResourceToTable', this.addResource);
      },

      onUpdateResource() : void {
         this.emitter.on('updateExistingResourcesInTable', this.updateResources);
      },

      updateTableHeaders(headers : string[]) : void {
         this.headers = headers;
      },

      updateResources(updateData : {
        updatedResources: object[], 
        replacementKey : string
      }) {
        let resourcesForMapping = this.resourceInstances;
        let {updatedResources,replacementKey} = updateData = updateData;

        updatedResources.forEach(updatedResource => {
          resourcesForMapping = resourcesForMapping.map(resourceExistingOnList => 
        resourceExistingOnList[replacementKey] === updatedResource [replacementKey] ? updatedResource  : resourceExistingOnList)
        });
        this.resourceInstances = resourcesForMapping;
      },

      emitEditEvent(resource) : void {
        this.$emit('edit', resource);
      },

      addResource(resource) : void {
         if(Array.isArray(resource)) {
            this.resourceInstances = this.resourceInstances.concat(resource);
         } else {
           this.resourceInstances.push(resource);
         }
      }

   },

   created() {
     this.onUpdateTableHeaders();
     this.onAddResource();
     this.onUpdateResource();
   }
}
</script>

<style lang="scss" scoped>
@import '~sass/fonts';

@mixin table-border {
  border: 1px solid white;
}

.resource-table {
  margin: 0 auto;
  @include responsive-font(1.2vw, 13px);
  @include table-border()
}

.resource-header {
  text-align: center;
  @include responsive-font(1.3vw, 15px);
  color:white;
  padding:5px;
  background: #0e621d;
  @include table-border()
}

.resource-cell {
  @include table-border();
 color: white;
 padding: 4px 3px;
}

.resource-row {
  cursor:pointer;
   &:nth-of-type(even) {
     background: black;
   }

   &:nth-of-type(odd) {
     background:#3a3a3a;
   }

   &:hover {
    background:#0f990f;
   }
}

.delete-cell{
    &:hover {
      background:red;
    }
  }

  .edit-cell {
    &:hover{
      background:dodgerblue;
    }
  }

@media screen and (max-width:800px){
  .table-headers {
    display :none;
  }

  .resource-cell {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;    
    &::before {
      content : attr(data-aditional-header) " : ";
      color:#06850a;
    }
  }

  .action-button {
    flex-grow:100;
  }
}

</style>