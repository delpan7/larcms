<div class="layui-elem-quote">
    <span class="layui-breadcrumb" style="font-size: 14px;">
        <a href="javascript:void(0);">内容管理</a>
        <a href="javascript:void(0);">栏目管理</a>
    </span>
</div>

<form class="layui-form" action="{{ route('menu.sort') }}" data-href="{{ route('menu.index') }}">
    <button class="layui-btn" lay-submit lay-filter="*">排序</button>
    <a class="layui-btn" href="{{ route('menu.create') }}">添加</a>
    <table class="layui-table" lay-skin="line">
        <thead>
            <tr>
                <th>栏目名称</th>
                <th>链接</th>
                <th>状态</th>
                <th>操作</th>
                <!-- <th>排序</th> -->
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $menu)
            <tr {!! $menu['depth'] ? "style='display:none;' class='children-from-{$menu['p_id']}'" : '' !!}>
                <td>
                    <i class="layui-icon tree-icon" style="margin-left:{{$menu['depth']*20}}px; display: inline-block; width:20px; font-size:20px;" data-node-id="{{$menu['id']}}">{{ $menu['has_children'] ? '&#xe623;' : '' }}</i>
                    <input type="number" name="sort[{{$menu['id']}}]" lay-verify='integer' maxlength="3" class="layui-input layui-input-inline"
                    style="width: 50px;" value="{{$menu['sort'] or 0}}">
                    {{$menu['name']}}[ID:{{$menu['id']}}]{!! $menu['mould_id'] ? "(文档：{$menu['content_count']})" : '' !!}
                </td>
                <td>{{$menu['url']}}</td>
                <td>{{$menu['is_hide'] ? '隐藏' : '显示'}}</td>
                <td>
                    <a href="{{ route('menu.create', ['p_id' => $menu['id']]) }}">添加子栏目</a>
                    <a href="{{ route('menu.edit', ['id' => $menu['id']]) }}">编辑</a>
                    <a onclick="destroy(this)" data-href="{{ route('menu.destroy', ['id' => $menu['id']]) }}" href="javascript:void(0);">删除</a>
                </td>
                <!-- <td><input type="number" name="sort[{{$menu['id']}}]" lay-verify='integer' maxlength="3" class="layui-input layui-input-inline"
                    style="width: 50px;" value="{{$menu['sort'] or 0}}"></td> -->
            </tr>
            @empty
            <tr>
                <td colspan="4" style="line-height:auto;">
                    <div style="text-align: center; margin: 10px;">
                        <i class="layui-icon" style="font-size:200px; display:block;line-height:200px">&#xe60e;</i>
                        暂无记录
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <button class="layui-btn" lay-submit lay-filter="*">排序</button>
    <a class="layui-btn" href="{{ route('menu.create') }}">添加</a>
</form>

<script>
    $(function () {
        loadLayui(); //加载Layui组件
        $(".tree-icon").click(function () {
            var node_id = $(this).attr('data-node-id');
            if ($(this).html() == '') {
                $(this).html('&#xe625;');
                // $('.children-from-'+node_id).show();
            } else {
                $(this).html('&#xe623;');
            }
            $('.children-from-' + node_id).toggle();
        });
    });
</script>