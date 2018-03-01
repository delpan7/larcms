<div class="layui-elem-quote">
    <span class="layui-breadcrumb" style="font-size: 14px;">
        <a href="javascript:void(0);">内容管理</a>
        <a href="javascript:void(0);">文章管理</a>
    </span>
</div>

<a class="layui-btn" href="{{ route('article.create') }}">添加</a>
<table class="layui-table" lay-even>
    <thead>
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>分类</th>
            <th>作者</th>
            <th>点击量</th>
            <th>评论量</th>
            <th>更新时间</th>
            <th>发布时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $article)
        <tr>
            <td>{{$article['id']}}</td>
            <td>{{$article['title']}}</td>
            <td>{{$article['menu_name']}}</td>
            <td>{{$article['writer']}}</td>
            <td>{{$article['read_count']}}</td>
            <td>{{$article['comment_count']}}</td>
            <td>{{$article['updated_at']}}</td>
            <td>{{$article['created_at']}}</td>
            <td>{{$article['status'] & 1 ? '置顶' : '未置顶'}}/{{$article['status'] & 2 ? '推荐' : '未推荐'}}</td>
            <td>
                <a href="{{ route('article.edit', ['id' => $article['id']]) }}">编辑</a>
                @if ($article['delete_at'])
                <a onclick="restore()" href="javascript:void(0);" data-href="{{ route('article.restore', ['id' => $article['id']]) }}">恢复</a>
                @else
                <a onclick="destroy()" href="javascript:void(0);" data-href="{{ route('article.destroy', ['id' => $article['id']]) }}">删除</a>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10">
                <div style="text-align: center; margin: 10px;">
                    <i class="layui-icon" style="font-size:200px; display:block;line-height:200px">&#xe60e;</i>
                    暂无记录
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
<a class="layui-btn" href="{{ route('article.create') }}">添加</a>

<script>
    $(function () {
        loadLayui(); //加载Layui组件
        // $(".layui-icon").click(function () {
        //     var node_id = $(this).attr('data-node-id');
        //     if ($(this).html() == '') {
        //         $(this).html('&#xe625;');
        //         // $('.children-from-'+node_id).show();
        //     } else {
        //         $(this).html('&#xe623;');
        //     }
        //     $('.children-from-' + node_id).toggle();
        // });
    });
</script>