<div class="layui-elem-quote">
    <span class="layui-breadcrumb" style="font-size: 14px;">
        <a href="javascript:void(0);">内容管理</a>
        <a href="javascript:void(0);">评论管理</a>
    </span>
</div>

<table class="layui-table" lay-even>
    <thead>
        <tr>
            <th>ID</th>
            <th>文章标题</th>
            <th>评论内容</th>
            <th>用户</th>
            <th>发布时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $comment)
        <tr>
            <td>{{$comment['id']}}</td>
            <td title="{{$comment->document->title}}">{{str_limit($comment->document->title,20)}}[ID:{{$comment->document->id}}](分类:{{$menu_list[$comment->document->menu_id]['name']}})</td>
            <td data-content="{{$comment['content']}}">{{str_limit($comment['content'], 20)}}</td>
            <td>{{$comment->user->nick_name}}</td>
            <td>{{$comment['created_at']}}</td>
            <td>{{$comment['status'] & 1 ? '审核通过' : ($comment['status'] & 2 ? '审核不通过' : '未审核') }}</td>
            <td>
                <span class="layui-breadcrumb" lay-separator="|" style="font-size: 14px;">
                    <!-- <a href="{{ route('comment.show', ['id' => $comment['id']]) }}">查看</a> -->
                    @if ($comment['status'] & 2)
                    <a onclick="approval(this)" href="javascript:void(0);" data-href="{{ route('comment.approval', ['id' => $comment['id'], 'type' => 'accept']) }}">审核通过</a>
                    @endif
                    @if ($comment['status'] & 1)
                    <a onclick="approval(this)" href="javascript:void(0);" data-href="{{ route('comment.approval', ['id' => $comment['id'], 'type' => 'reject']) }}">审核不通过</a>
                    @endif
                    <a onclick="destroy(this)" href="javascript:void(0);" data-href="{{ route('comment.destroy', ['id' => $comment['id']]) }}">删除</a>
                </span>
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

    /**
     * 审核通过/不通过
     *
     * @return void
     */
    function approval(e) {
        $.ajax({
            url: $(e).attr('data-href'),
            type: 'post',
            success: function (res) {
                layer.msg(res.message);
                if (res.status == 200) {
                    $.pjax.reload('#pjax-container');
                }
            }
        });
    }

   
</script>