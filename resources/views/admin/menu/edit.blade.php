<div class="layui-elem-quote">
  <span class="layui-breadcrumb" style="font-size: 14px;">
    <a href="javascript:void(0);">内容管理</a>
    <a href="javascript:void(0);">栏目管理</a>
    <a href="javascript:void(0);">编辑栏目</a>
  </span>
</div>
<form class="layui-form" action="{{ route('menu.update', ['id' => $data['id']]) }}" success-href="{{ route('menu.index') }}">
  <input type="hidden" name="_method" value="PUT">
  <div class="layui-form-item">
    <label class="layui-form-label">上级</label>
    <div class="layui-input-block">
      <select name="p_id" lay-verify="required">
        <option value="0">一级栏目</option>
        @foreach ($menu_list as $menu)
        <option value="{{ $menu['id'] }}" {!! ($data['mould_id'] && $menu['mould_id'] != $data['mould_id']) ? 'disabled' : '' !!} {!! $data['p_id'] == $menu['id'] ? 'selected' : '' !!}>{{ $menu['tree_name'] }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">栏目名称</label>
    <div class="layui-input-block">
      <input type="text" name="name" required lay-verify="required" placeholder="请输入栏目名称" autocomplete="off" class="layui-input" value="{{$data['name']}}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">链接地址</label>
    <div class="layui-input-block">
      <input type="text" name="url" required lay-verify="required" placeholder="请输入链接地址" autocomplete="off" class="layui-input" value="{{$data['url']}}">
    </div>
    <div class="layui-form-mid layui-word-aux"></div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">隐藏</label>
    <div class="layui-input-block">
      <input type="checkbox" name="is_hide" lay-skin="switch" {!! $data['is_hide'] ? 'checked' : '' !!}>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">排序</label>
    <div class="layui-input-inline" style="width:58px;">
      <input type="number" name="sort" lay-verify="number" maxlength="3" class="layui-input" value="{{$data['sort']}}">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">选择模型</label>
    <div class="layui-input-block">
      <select name="mould_id" lay-verify="required">
        <option value="0" {!! $data['mould_id'] == 0 ? 'selected' : 'disabled' !!}>单页</option>
        @foreach ($mould_list as $id=>$mould)
        <option value="{{ $id }}" {!! $data['mould_id'] == $id ? 'selected' : 'disabled' !!}>{{ $mould }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">关键字</label>
    <div class="layui-input-block">
      <input type="text" name="keywords" placeholder="请输入关键字" autocomplete="off" class="layui-input" value="{{$data['keywords']}}">
      <div class="layui-form-mid layui-word-aux">页面SEO关键字</div>
    </div>

  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
      <textarea name="description" placeholder="请输入描述" class="layui-textarea">{{$data['description']}}</textarea>
      <div class="layui-form-mid layui-word-aux">页面SEO描述</div>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">内容</label>
    <div class="layui-input-block">
      <textarea id="content" name="content" placeholder="请输入内容" class="layui-textarea">{{$data['content']}}</textarea>
      <div class="layui-form-mid layui-word-aux">单页面时展示内容</div>
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
  });
</script>