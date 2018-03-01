<style lang="less">
@import "../../styles/common.less";
@import "./components/table.less";
</style>

<template>
    <div class="edittable-con-1">
        <div style="margin-bottom:10px">
            <Button type="primary" v-on:click="handleSort">排序</Button>
            <Button type="primary" v-on:click="handleAdd()">添加</Button>
        </div>
        <tree-toggle iconType="arrow-right-b"></tree-toggle>
        <Table stripe border :row-class-name="rowClassName" :columns="columnsList" :data="tableData"></Table>
        <div style="margin-top:10px">
            <Button type="primary" v-on:click="handleSort">排序</Button>
            <Button type="primary" v-on:click="handleAdd()">添加</Button>
        </div>
    </div>
</template>

<script>
import tableData from "./components/table_data.js";
import TreeToggle from "../components/TreeToggle";
const addButton = (vm, h, params) => {
  return h(
    "Button",
    {
      props: {
        type: "primary"
        // loading: currentRow.saving
      },
      style: {
        margin: "0 5px"
      },
      on: {
        click: () => {
          vm.handleAdd(params.row.id);
          //   let argu = { pid: params.row.id };
          //   vm.$router.push({
          //     name: "menu_add",
          //     params: argu
          //   });
        }
      }
    },
    "添加子菜单"
  );
};
const editButton = (vm, h, params) => {
  return h(
    "Button",
    {
      props: {
        type: "primary"
        // loading: currentRow.saving
      },
      style: {
        margin: "0 5px"
      },
      on: {
        click: () => {
          vm.handleEdit(params.row.id);
          //   let argu = { id: params.row.id };
          //   vm.$router.push({
          //     name: "menu_add",
          //     params: argu
          //   });
        }
      }
    },
    "修改"
  );
};
const deleteButton = (vm, h, params) => {
  let delete_url = vm.$router.resolve({
    name: "menu_delete",
    params: { id: params.row.id }
  });
  return h(
    "Poptip",
    {
      props: {
        confirm: true,
        title: "您确定要删除这条数据吗?",
        transfer: true
      },
      on: {
        "on-ok": () => {
          vm.tableData.splice(index, 1);
          vm.$emit("input", vm.handleBackdata(vm.tableData));
          vm.$emit("on-delete", vm.handleBackdata(vm.tableData), index);
        }
      }
    },
    [
      h(
        "Button",
        {
          style: {
            margin: "0 5px"
          },
          props: {
            type: "error",
            placement: "top"
          }
        },
        "删除"
      )
    ]
  );
};

export default {
  data() {
    return {
      columnsList: [],
      tableData: [],
      order: []
    };
  },
  components: {
    "tree-toggle": TreeToggle
  },
  methods: {
    toggleData(id) {
      let toggle_index = this.getIndexById(id);
      if (this.tableData[toggle_index].next) {
        let next_id = this.tableData[toggle_index].next;
        let next_index = this.getIndexById(next_id);
        this.tableData.splice(toggle_index + 1, next_index - 1);
        delete this.tableData[toggle_index].next;
      } else {
        this.tableData[toggle_index]["next"] = this.tableData[toggle_index + 1][
          "id"
        ];

        if (this.tableData[toggle_index].children) {
          this.tableData.splice(
            toggle_index + 1,
            0,
            ...this.tableData[toggle_index].children
          );
        }
      }
      console.log(this.tableData);
    },
    getIndexById(id) {
      let index = this.tableData.findIndex((value, index, arr) => {
        return value.id == id;
      });

      return index;
    },
    // formatData(data, pid = 0, depth = 0) {
    //   let table_data = [];
    //   data.forEach(item => {
    //     item["depth"] = depth;
    //     item["pid"] = pid;
    //     if (pid) {
    //       item["hide"] = 1;
    //     }
    //     let children_data = [];

    //     if (item.children) {
    //       children_data = this.formatData(item.children, depth + 1, item.id);
    //       delete item["children"];
    //       // console.log(children_data);
    //     }
    //     table_data.push(item);
    //     table_data = table_data.concat(children_data);
    //   });
    //   // console.log(table_data);
    //   return table_data;
    // },
    getData() {
      this.columnsList = tableData.table1Columns;
      this.tableData = tableData.table1Data;

      let vm = this;
      this.columnsList.forEach(item => {
        if (item.order) {
          item.render = (h, params) => {
            vm.order[params.row.id] = params.row.sort;
            let data = { isOpen: false };
            return h("div", [
              h(
                "tree-toggle",
                {
                  props: {
                    iconType: params.row.children ? "arrow-right-b" : "",
                    isOpen: false
                  },
                  on: {
                    handleClick(event) {
                      console.log(vm.$refs.treeToggle);
                      // handleClick: () => {
                      console.log("ccc");
                      if(params.row.children){
                        vm.toggleData(params.row.id);
                      }
                    }
                  },
                  nativeOn: {
                    click: event => {
                      console.log("mmmmmmm");
                      // vm.toggleData(params.row.id);
                    } //,
                  },
                  ref: 'treeToggle'
                } //,
                // [
                //   h("Icon", {
                //     props: {
                //       type: params.row.children ? "arrow-right-b" : ""
                //     },
                //     style: {
                //       marginLeft: params.row.depth * 10 + "px"
                //     }
                //     // nativeOn: {
                //     //   click: event => {
                //     //     console.log("mmmmmmm");
                //     //     vm.toggleData(params.row.id);
                //     //   } //,
                //     // }
                //   })
                // ]
              ),
              h("Input", {
                props: {
                  type: "text",
                  inline: true,
                  value: params.row.sort
                },
                style: {
                  width: "40px",
                  marginLeft: "5px"
                },
                attrs: {
                  maxlength: 3
                },
                on: {
                  "on-change"(event) {
                    vm.order[params.row.id] = event.target.value;
                  }
                }
              })
            ]);
          };
        }
        if (item.handle) {
          item.render = (h, params) => {
            return h("div", [
              addButton(this, h, params),
              editButton(this, h, params),
              deleteButton(this, h, params)
            ]);
          };
        }
      });
    },
    handleAdd(id) {
      if (!id) {
        id = 0;
      }
      let argu = { pid: id };
      this.$router.push({
        name: "menu_add",
        params: argu
      });
    },
    handleEdit(id) {
      if (id) {
        let argu = { id: id };
        this.$router.push({
          name: "menu_add",
          params: argu
        });
      }
    },
    handleSort() {
      console.log(this.order);
    },
    handleNetConnect(state) {
      this.breakConnect = state;
    },
    handleLowSpeed(state) {
      this.lowNetSpeed = state;
    },
    getCurrentData() {
      this.showCurrentTableData = true;
    },
    handleDel(val, index) {
      this.$Message.success("删除了第" + (index + 1) + "行数据");
    },
    handleCellChange(val, index, key) {
      this.$Message.success("修改了第 " + (index + 1) + " 行列名为 " + key + " 的数据");
    },
    handleChange(val, index) {
      this.$Message.success("修改了第" + (index + 1) + "行数据");
    },
    rowClassName(row, index) {
      let class_name = "";
      if (row.pid) {
        class_name += " child-of-node-" + row.pid;
      }
      if (row.hide) {
        // class_name += " hide";
      }
      return class_name;
    }
  },
  created() {
    this.getData();
  }
};
</script>
