<template>
    <span ref="treeToggle" :class="{'ivu-tree-arrow': true, 'ivu-tree-arrow-open': treeOpen}" v-on:click="toggle()" >
        <Icon :type="iconType"></Icon>
    </span>
</template>

<script>
export default {
  name: "TreeToggle",
  props: {
    iconType: String,
    isOpen:{
      type : Boolean,
      default: false
    }
  },
  data() {
    return {
      treeOpen: this.isOpen
    };
  },
  methods: {
    toggle() {
      console.log(this.$children.isOpen);
      // this.$parent.isOpen = !this.$parent.isOpen;
      console.log(this.$parent.isOpen);
      this.$emit('handleClick')
    }
  }
};
</script>
