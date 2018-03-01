<div class="layui-elem-quote">
    <span class="layui-breadcrumb" style="font-size: 14px;">
        <a href="javascript:void(0);">内容管理</a>
        <a href="javascript:void(0);">文章管理</a>
        <a href="javascript:void(0);">添加文章</a>
    </span>
</div>
<form class="layui-form" action="{{ route('article.store') }}" success-href="{{ route('article.index') }}">
    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-block">
            <input type="text" name="name" required lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">文章分类</label>
        <div class="layui-input-block">
            <select name="menu_id" lay-verify="required">
                <option value="">请选择分类</option>
                @foreach ($menu_list as $menu)
                <option value="{{ $menu['id'] }}" {!! $menu_id == $menu['id'] ? 'selected' : '' !!} {!! !$menu['mould_id'] ? 'disabled' : '' !!}>{{ $menu['tree_name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">缩 略 图</label>
        <div class="layui-input-block">
            <input type="hidden" name="thumb">
            <a class="layui-btn upload-image" lay-data="{url: '/admin/upload/', size:'100000'}">上传图片</a>
        </div>
        <div class="layui-form-mid layui-word-aux"></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">关键字</label>
        <div class="layui-input-block">
            <input type="text" name="keywords" placeholder="请输入关键字" autocomplete="off" class="layui-input">
        </div>

    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">内容摘要</label>
        <div class="layui-input-block">
            <textarea name="description" placeholder="请输入内容摘要" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">内容</label>
        <div class="layui-input-block">
            <textarea id="content" name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
            <div class="layui-form-mid layui-word-aux"></div>
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