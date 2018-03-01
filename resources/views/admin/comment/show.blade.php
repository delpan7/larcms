<div class="layui-elem-quote">
  <span class="layui-breadcrumb" style="font-size: 14px;">
    <a href="javascript:void(0);">评论管理</a>
    <a href="javascript:void(0);">评论详情</a>
  </span>
</div>
<table class="layui-table" lay-even>
  <colgroup>
    <col width="20">
    <col width="350">
    <col>
  </colgroup>
  <tbody>
      <tr>
          <td>评论文章</td>
          <td>{{$data->document->title}}[ID:{{$data->document->id}}](分类:{{$menu_list[$data->document->menu_id]['name']}})</td>
      </tr>
      <tr>
          <td>用户名</td>
          <td>{{$data->user->nick_name}}</td>
      </tr>
      <tr>
          <td>内容</td>
          <td>{{$data->content}}</td>
      </tr>
      <tr>
          <td>状态</td>
          <td>{{$data->status & 1 ? '审核通过' : ($data->status & 2 ? '审核不通过' : '未审核')}}</td>
      </tr>
      <tr>
          <td>评论时间</td>
          <td>{{$data->created_at}}</td>
      </tr>
  </tbody>
</table>

<script>
  $(function () {
    loadLayui(); //加载Layui组件
  });
</script>