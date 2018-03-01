<div class="layui-elem-quote">
    <span class="layui-breadcrumb" style="font-size: 14px;">
        <a href="javascript:void(0);">内容管理</a>
        <a href="javascript:void(0);">文章管理</a>
    </span>
</div>

<a class="layui-btn" href="{{ route('user.create') }}">添加</a>
<table class="layui-table" lay-even>
    <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>Email</th>
            <th>性别</th>
            <th>生日</th>
            <th>电话</th>
            <th>最后登陆时间</th>
            <th>注册时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $article)
        <tr>
            <td>{{$article['id']}}</td>
            <td>{{$article['name']}}</td>
            <td>{{$article['email']}}</td>
            <td>{{$article['sex'] == 1 ? '男' : ($article['sex'] == 2 ? '女' : '')}}</td>
            <td>{{$article['birthday']}}</td>
            <td>{{$article['phone']}}</td>
            <td>{{$article['logined_at']}}</td>
            <td>{{$article['created_at']}}</td>
            <td>{{$article['status'] & 1 ? '锁定' : '正常'}}</td>
            <td>
                <a href="{{ route('article.edit', ['id' => $article['id']]) }}">编辑</a>
                <a onclick="destroy()" href="javascript:void(0);" data-href="{{ route('article.destroy', ['id' => $article['id']]) }}">删除</a>
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