$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//文章状态审核
$('.post-audit').click(function (event) {
    target = $(event.target);
    var post_id = target.attr('post-id');
    var status = target.attr('post-action-status');

    $.ajax({
        url: '/admin/posts/' + post_id + '/status',
        method: 'post',
        data: {'status': status},
        dataType: 'json',
        success: function (data) {
            if (data.error != 0) {
                alert(data.msg);
                return;
            }
            target.parent().parent().remove();
            //     history.go(0);
        }
    });
});

/*
删除专题操作
* */
$('.resource-delete').click(function (event) {
    if (confirm('确认执行删除操作吗？') == false) {
        return;
    }
    event.preventDefault();
    var target = $(event.target);
    var url = $(target).attr('delete-url');
    $.ajax({
        url: url,
        method: 'post',
        data: {'_method': 'delete'},
        dataType: 'json',
        success: function (data) {
            if (data.error != 0) {
                alert(data.msg);
                return false;
            }
            window.location.reload();
        }
    });
});

/*
* 删除管理员*/

$('.delete_user').click(function (event) {
    if (confirm('确认执行删除操作？') == false) {
        return;
    }
    event.preventDefault();
    var target = $(event.target);
    var url = $(target).attr('delete-url');
    $.ajax({
        url: url,
        method: 'get',
        // data: {'_method': 'delete'},
        dataType: 'json',
        success: function (data) {
            if (data.error != 0) {
                alert(data.msg);
                return false;
            }
            window.location.reload();
        }
    });

});

/*
* 修改管理员状态（软删除）*/
$('.user-audit').click(function (event) {
    if (confirm('确认执行删除操作？') == false) {
        return;
    }
    var target = $(event.target);
    var user_id = $(target).attr('user-id');
    var status = $(target).attr('user-action-status');
    $.ajax({
        url: '/admin/users/' + user_id + '/status',
        method: 'post',
        data: {'status': status},
        dataType: 'json',
        success: function (data) {
            if (data.error != 0) {
                alert(data.error);
                return false;
            }
            target.parent().parent().remove();
        }
    })
})

/*
* 修改栏目状态（软删除）*/
$('.category-audit').click(function (event) {
    if (confirm('确认执行删除操作？') == false) {
        return;
    }
    var target = $(event.target);
    var cate_id = $(target).attr('cate-id');
    var status = $(target).attr('cate-action-status');
    $.ajax({
        url: '/admin/categorys/' + cate_id + '/status',
        method: 'post',
        data: {'status': status},
        dataType: 'json',
        success: function (data) {
            if (data.error != 0) {
                alert(data.error);
                return false;
            }
            target.parent().parent().remove();
        }
    })
})



