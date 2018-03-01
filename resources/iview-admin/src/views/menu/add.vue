<style lang="less">
    @import '../../styles/common.less';
    @import './components/table.less';
</style>

<template>
    <div class="edittable-con-1">
        <Table border :columns="columnsList" :data="tableData"></Table>
    </div>
</template>

<script>
import tableData from './components/table_data.js';
const addButton = (vm, h, params) => {
    return h('Button', {
        props: {
            type: 'primary' ,
            // loading: currentRow.saving
        },
        style: {
            margin: '0 5px'
        },
        on: {
            'click': () => {
                let argu = { pid: params.row.id };
                vm.$router.push({
                    name: 'menu_add',
                    params: argu
                });
            }
        }
    }, '添加子菜单');
};
const editButton = (vm, h, params) => {
    return h('Button', {
        props: {
            type: 'primary' ,
            // loading: currentRow.saving
        },
        style: {
            margin: '0 5px'
        },
        on: {
            'click': () => {
                let argu = { id: params.row.id };
                vm.$router.push({
                    name: 'menu_add',
                    params: argu
                });
            }
        }
    }, '修改');
};
const deleteButton = (vm, h, params) => {
    let delete_url = vm.$router.resolve({ name: 'menu_delete', params: { id: params.row.id }});
    return h('Poptip', {
        props: {
            confirm: true,
            title: '您确定要删除这条数据吗?',
            transfer: true
        },
        on: {
            'on-ok': () => {
                vm.tableData.splice(index, 1);
                vm.$emit('input', vm.handleBackdata(vm.tableData));
                vm.$emit('on-delete', vm.handleBackdata(vm.tableData), index);
            }
        }
    }, [
        h('Button', {
            style: {
                margin: '0 5px'
            },
            props: {
                type: 'error',
                placement: 'top'
            }
        }, '删除')
    ]);
};
export default {
    data () {
        return {
            columnsList: [],
            tableData: [],
        };
    },
    methods: {
        getData () {
            this.columnsList = tableData.table1Columns;
            this.tableData = tableData.table1Data;
            this.columnsList.forEach(item => {
                if (item.order) {
                    item.render = (h, params) => {
                        return h('Input', {
                            props: {
                                type: 'text',
                                size: 'small',
                                value: params.row.sort
                            }
                        });
                    }
                }
                if (item.handle) {
                    item.render = (h, params) => {
                        return h('div', [
                            addButton(this, h, params),
                            editButton(this, h, params),
                            deleteButton(this, h, params)
                        ]);
                    }
                }
            });
            
        },
        handleNetConnect (state) {
            this.breakConnect = state;
        },
        handleLowSpeed (state) {
            this.lowNetSpeed = state;
        },
        getCurrentData () {
            this.showCurrentTableData = true;
        },
        handleDel (val, index) {
            this.$Message.success('删除了第' + (index + 1) + '行数据');
        },
        handleCellChange (val, index, key) {
            this.$Message.success('修改了第 ' + (index + 1) + ' 行列名为 ' + key + ' 的数据');
        },
        handleChange (val, index) {
            this.$Message.success('修改了第' + (index + 1) + '行数据');
        }
    },
    created () {
        this.getData();
    }
};
</script>
