<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config("app.name", "后台管理") }}</title>
  <link rel="stylesheet" href="/layui/css/layui.css">
</head>

<body class="layui-layout-body">
  <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
      <div class="layui-logo">LarCms</div>
      <!-- 头部区域（可配合layui已有的水平导航） -->
      <ul class="layui-nav layui-layout-left" id="menuHeader">
        <li class="layui-nav-item layui-this" data-id="1">
          <a href="javascript:void(0);">内容管理</a>
        </li>
        <li class="layui-nav-item" data-id="2">
          <a href="javascript:void(0);">用户管理</a>
        </li>
        <li class="layui-nav-item" data-id="3">
          <a href="javascript:void(0);">系统设置</a>
        </li>
        <!-- <li class="layui-nav-item">
        <a href="javascript:void(0);">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="javascript:void(0);">邮件管理</a></dd>
          <dd><a href="javascript:void(0);">消息管理</a></dd>
          <dd><a href="javascript:void(0);">授权管理</a></dd>
        </dl>
      </li> -->
      </ul>
      <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
          <a href="javascript:void(0);">
            <img src="http://t.cn/RCzsdCq" class="layui-nav-img"> 贤心
          </a>
          <dl class="layui-nav-child">
            <dd>
              <a href="javascript:void(0);">基本资料</a>
            </dd>
            <dd>
              <a href="javascript:void(0);">安全设置</a>
            </dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:void(0);">退了</a>
        </li>
      </ul>
    </div>

    <div class="layui-side layui-bg-black">
      <div class="layui-side-scroll" id="menuBody">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree layui-tab-item layui-show" lay-filter="test">
          <li class="layui-nav-item layui-this">
            <a href="/admin/menu">栏目管理</a>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:void(0);">文章管理</a>
            <dl class="layui-nav-child">
              <dd>
                <a href="/admin/article">新闻管理</a>
              </dd>
              <dd>
                <a href="javascript:void(0);">站内新闻</a>
              </dd>
              <dd>
                <a href="javascript:void(0);">图片管理</a>
              </dd>
            </dl>
          </li>
          <li class="layui-nav-item">
            <a href="/admin/message">所有留言</a>
          </li>
          <li class="layui-nav-item">
            <a href="/admin/comment">评论管理</a>
          </li>
        </ul>

        <ul class="layui-nav layui-nav-tree layui-tab-item" lay-filter="test">
          <li class="layui-nav-item">
            <a href="/admin/user">用户管理</a>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:void(0);">管理组</a>
            <dl class="layui-nav-child">
              <dd>
                <a href="javascript:void(0);" data-url="/admin/admin">管理员</a>
              </dd>
              <dd>
                <a href="javascript:void(0);" data-url="/admin/role">角色管理</a>
              </dd>
            </dl>
          </li>
        </ul>

        <ul class="layui-nav layui-nav-tree layui-tab-item" lay-filter="test">
          <li class="layui-nav-item">
            <a href="javascript:void(0);" data-url="/admin/node">后台菜单</a>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:void(0);" data-url="/admin/article">个人信息</a>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:void(0);" data-url="/admin/setting">网站设置</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="layui-body">
      <!-- 内容主体区域 -->
      <div id="pjax-container" style="padding: 15px;">内容区


        <div lay-filter="demo">
          <ul id="layuiTab" class="layui-tab-title">
            <li class="layui-this">网站设置</li>
            <li>商品管理</li>
            <li>订单管理</li>
          </ul>

        </div>
        <div id="layuiContent">
          <div class="layui-tab-item layui-show">内容1</div>
          <div class="layui-tab-item">内容2</div>
          <div class="layui-tab-item">内容3</div>
        </div>
      </div>
    </div>

    <div class="layui-footer">
      <!-- 底部固定区域 -->
      © layui.com - 底部固定区域
    </div>
  </div>
  <script src="/js/jquery-3.2.1.js"></script>
  <script src="/js/jquery.pjax.js"></script>
  <script src="/layui/layui.js"></script>
  <script>
    var layer;
    $(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $(document).pjax('a', '#pjax-container');

      //JavaScript代码区域
      layui.use(["element", 'layer'], function () {
        var element = layui.element;
        var layer = layui.layer;

        element.tab({
          headerElem: "#menuHeader>li", //指定tab头元素项
          bodyElem: "#menuBody>ul" //指定tab主体元素项
        });
      });
    });

    /**
     * 加载Layui组件
     *
     * @return void
     */
    function loadLayui() {
      layui.use(['element', 'form', 'layedit', 'upload', 'laydate'], function () {
        var element = layui.element;
        var form = layui.form;
        var upload = layui.upload;
        var laydate = layui.laydate;
        //日期
        laydate.render({
          elem: '.date'
        });
        element.render();
        form.render();
        if ($('#content').get(0)) {
          var layedit = layui.layedit;
          layedit.build('content'); //建立编辑器
        }
        if($("[data-content]").get(0)){
          var index;
          $("[data-content]").hover(function(){
            index = layer.tips($(this).attr('data-content'), $(this), {time: 0});
          },function(){
            setTimeout(function(){
              layer.close(index);
            }, 500);
          });
        }

        upload.render({
          elem: '.upload-image',
          url: '',
          before: function (obj) { //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
            layer.load(); //上传loading
          },
          done: function (res, index, upload) {
            layer.closeAll('loading'); //关闭loading
            //获取当前触发上传的元素，一般用于 elem 绑定 class 的情况，注意：此乃 layui 2.1.0 新增
            var item = this.item;
          },
          error: function (index, upload) {
            layer.closeAll('loading'); //关闭loading
          }
        });

        form.on('submit(*)', function (data) {
          $.ajax({
            url: data.form.action,
            data: data.field,
            type: data.field._method || 'post',
            success: function (res) {
              layer.msg(res.message);
              if (res.status == 200) {
                if ($(data.form).attr("success-href")) {
                  // location.href = $(data.form).attr("success-href");
                  $.pjax({
                    url: $(data.form).attr("success-href"),
                    container: '#pjax-container'
                  });
                } else {
                  window.history.go(-1);
                }
              }
            }
          });
          return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
      });
    }

    /**
     * 删除资源
     *
     * @return void
     */
    function destroy(e) {
      layer.confirm('你确定要删除该文章?', {
        icon: 3,
        title: '删除提示'
      }, function (index) {
        $.ajax({
          url: $(e).attr('data-href'),
          type: 'delete',
          success: function (res) {
            layer.msg(res.message);
            if (res.status == 200) {
              $.pjax.reload('#pjax-container');
            }
          }
        });
        layer.close(index);
      });
    }

    /**
     * 恢复删除的资源
     *
     * @return void
     */
    function restore(e) {
      layer.confirm('你确定要恢复该文章?', {
        icon: 3,
        title: '恢复提示'
      }, function (index) {
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
        layer.close(index);
      });

    }
  </script>
</body>

</html>