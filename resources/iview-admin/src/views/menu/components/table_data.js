export const table1Columns = [
    {
        title: '排序',
        // width: 120,
        align: 'center',
        order: true
    },
    {
        title: 'ID',
        width: 80,
        key: 'id',
        align: 'center'
    },
    {
        title: '姓名',
        align: 'center',
        key: 'name',
        editable: true
    },
    {
        title: '性别',
        align: 'center',
        key: 'sex'
    },
    {
        title: '岗位',
        align: 'center',
        key: 'work',
        editable: true
    },
    {
        title: '操作',
        align: 'center',
        width: 280,
        key: 'handle',
        handle: ['delete']
    }
];

export const table1Data = [
    {
        id: 1,
        name: 'Aresn',
        sex: '男',
        work: '前端开发',
        sort: 1,
        depth: 0,
        pid: 0,
        children: [
            {
                id: 4,
                name: 'Lison',
                sex: '男',
                work: '前端开发',
                sort: 2,
                depth: 1,
                pid: 1
            },
            {
                id: 5,
                name: 'lisa',
                sex: '女',
                work: '程序员鼓励师',
                sort: 3,
                depth: 1,
                pid: 1
            }
        ]
    },
    {
        id: 2,
        name: 'Lison',
        sex: '男',
        work: '前端开发',
        sort: 2,
        depth: 0,
        pid: 0
    },
    {
        id: 3,
        name: 'lisa',
        sex: '女',
        work: '程序员鼓励师',
        sort: 3,
        depth: 0,
        pid: 0
    }
];

export const editInlineColumns = [
    {
        title: '序号',
        type: 'index',
        width: 80,
        align: 'center'
    },
    {
        title: '姓名',
        align: 'center',
        key: 'name',
        width: 90,
        editable: true
    },
    {
        title: '性别',
        align: 'center',
        key: 'sex'
    },
    {
        title: '岗位',
        align: 'center',
        key: 'work',
        width: 150,
        editable: true
    },
    {
        title: '操作',
        align: 'center',
        width: 190,
        key: 'handle',
        handle: ['edit', 'delete']
    }
];

export const editInlineData = [
    {
        name: 'Aresn',
        sex: '男',
        work: '前端开发'
    },
    {
        name: 'Lison',
        sex: '男',
        work: '前端开发'
    },
    {
        name: 'lisa',
        sex: '女',
        work: '程序员鼓励师'
    }
];

export const editIncellColumns = [
    {
        title: '序号',
        type: 'index',
        width: 80,
        align: 'center'
    },
    {
        title: '姓名',
        align: 'center',
        key: 'name',
        width: 120,
        editable: true
    },
    {
        title: '性别',
        align: 'center',
        key: 'sex'
    },
    {
        title: '岗位',
        align: 'center',
        width: 160,
        key: 'work',
        editable: true
    },
    {
        title: '操作',
        align: 'center',
        width: 120,
        key: 'handle',
        handle: ['delete']
    }
];

export const editIncellData = [
    {
        name: 'Aresn',
        sex: '男',
        work: '前端开发'
    },
    {
        name: 'Lison',
        sex: '男',
        work: '前端开发'
    },
    {
        name: 'lisa',
        sex: '女',
        work: '程序员鼓励师'
    }
];

export const editInlineAndCellColumn = [
    {
        title: '序号',
        type: 'index',
        width: 80,
        align: 'center'
    },
    {
        title: '姓名',
        align: 'center',
        key: 'name',
        width: 300,
        editable: true
    },
    {
        title: '性别',
        align: 'center',
        key: 'sex'
    },
    {
        title: '岗位',
        align: 'center',
        width: 300,
        key: 'work',
        editable: true
    },
    {
        title: '操作',
        align: 'center',
        width: 200,
        key: 'handle',
        handle: ['edit', 'delete']
    }
];

export const editInlineAndCellData = [
    {
        name: 'Aresn',
        sex: '男',
        work: '前端开发'
    },
    {
        name: 'Lison',
        sex: '男',
        work: '前端开发'
    },
    {
        name: 'lisa',
        sex: '女',
        work: '程序员鼓励师'
    }
];

export const showCurrentColumns = [
    {
        title: '序号',
        type: 'index',
        width: 80,
        align: 'center'
    },
    {
        title: '姓名',
        align: 'center',
        key: 'name',
        width: 300,
        editable: true
    },
    {
        title: '性别',
        align: 'center',
        key: 'sex'
    },
    {
        title: '岗位',
        align: 'center',
        width: 300,
        key: 'work',
        editable: true
    }
];

const tableData = {
    table1Columns: table1Columns,
    table1Data: table1Data,
    editInlineColumns: editInlineColumns,
    editInlineData: editInlineData,
    editIncellColumns: editIncellColumns,
    editIncellData: editIncellData,
    editInlineAndCellColumn: editInlineAndCellColumn,
    editInlineAndCellData: editInlineAndCellData,
    showCurrentColumns: showCurrentColumns
};

export default tableData;
