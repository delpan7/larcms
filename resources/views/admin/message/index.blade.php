<div class="layui-elem-quote">
    <span class="layui-breadcrumb" style="font-size: 14px;">
        <a href="javascript:void(0);">内容管理</a>
        <a href="javascript:void(0);">留言管理</a>
    </span>
</div>

<table class="layui-table" lay-even>
    <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>手机</th>
            <th>Email</th>
            <th>内容</th>
            <th>回复</th>
            <th>留言时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $message)
        <tr>
            <td>{{$message['id']}}</td>
            <td>{{$message['user_name']}}</td>
            <td>{{$message['phone']}}</td>
            <td>{{$message['email']}}</td>
            <td>{{$message['content']}}</td>
            <td>{{$message['reply']}}</td>
            <td>{{$message['created_at']}}</td>
            <td>
                @if (!$message['reply'])
                <a onclick="reply(this)" href="javascript:void(0);" data-href="{{ route('message.reply', ['id' => $message['id']]) }}">回复</a>
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