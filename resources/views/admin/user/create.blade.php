<div class="layui-elem-quote">
    <span class="layui-breadcrumb" style="font-size: 14px;">
        <a href="javascript:void(0);">用户管理</a>
        <a href="javascript:void(0);">用户管理</a>
    </span>
</div>
<form class="layui-form" action="{{ route('article.store') }}" success-href="{{ route('article.index') }}">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="name" required lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">Email</label>
        <div class="layui-input-block">
            <input type="text" name="email" required lay-verify="required" placeholder="请输入Email" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">妮称</label>
        <div class="layui-input-block">
            <input type="text" name="nick_name" placeholder="请输入妮称" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">性别</label>
        <div class="layui-input-block">
            <input type="radio" name="sex" value="1" title="男" checked>
            <input type="radio" name="sex" value="2" title="女">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">出生日期</label>
        <div class="layui-input-block">
            <input type="text" name="birthday" placeholder="请选择出生日期" autocomplete="off" class="layui-input date" lay-verify="date">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机</label>
        <div class="layui-input-block">
            <input type="text" name="phone" placeholder="请输入手机" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script>
    $(function () {
        loadLayui(); //加载Layui组件

        layui.use(['form', 'layer'], function () {
            var form = layui.form;
            var layer = layui.layer;
        });
    });
</script>