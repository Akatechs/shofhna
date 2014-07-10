$.fn.replace_urls = function () {
    var a = /(\b(https?|ftp):\/\/[^\s<>"'\(\)]+)/gi;
    this.each(function () {
        $(this).find("p").each(function () {
            $(this).html($(this).html().replace(a, '<a href="$1" rel="nofollow" target="_blank" style="direction:ltr;display:inline-block;text-align:right">$1</a>'))
        })
    });
    return $(this)
};
function setYoutubeTime()
{
    try {
        var hash = window.location.hash;
        if(hash)
        {
            var iframe = $("#iframe-youtube");
            var src = iframe.attr("src");
            var indexofhash = src.indexOf("?");
            if (indexofhash > 0)
            {
                src = src.substring(0,indexofhash);
            }
            src = src + hash.replace("#","?") + "&autoplay=1";
            iframe.attr("src", src);
        }
    } catch (c) {}
}

$(window).bind("hashchange", function () {
    //if (window.location.hash && window.location.hash.match(/start=(\d)/g))
     {
        setYoutubeTime();
    }
});

$(window).bind("load", function () {
    if (window.location.hash && window.location.hash.match(/comment_(\d)/g)) {
        try {
            var b = window.location.hash.split("_")[1];
            var a = ($("#comment-" + b).offset().top) - 85;
            $("html, body").scrollTop(a)
        } catch (c) {}
    }
    
    setYoutubeTime();
    
    
});
$(document).ready(function () {
    $.ajaxSetup({
        cache: false
    });
    $("body").ajaxStart(function () {
        ajax_loading = true
    });
    $("body").ajaxStop(function () {
        ajax_loading = false
    });
    /*$(".nailthumb-container").nailthumb({
        replaceAnimation: null
    });*/
    
    //http://harvesthq.github.io/chosen/options.html
    $(".chosen-select").chosen({
        width:"250px"
        
    });
    
    $(".upvote_btn").live("click", function (m) {
        m.preventDefault();
        var k = $(this).attr("id").split("-")[1];
        var l = $("#user_token").val();
        var base_url = $("#base_url").val();
        var n = $(this).parent().parent().find(".post_points");
        if (l) {
            $.post(base_url + "/post/" + k + "/upvote", {
                _token: l
            }, function (o) {
                if (typeof o.points != "undefined") {
                    n.text(o.points).fadeOut(200).fadeIn(200)
                }
                if (o.msg) {
                   /* show_alert({
                        title: "تنبيه",
                        body: o.msg,
                        button_text: "إغلاق",
                        action: "close"
                    })*/
                    alert(o.msg);
                }
            }, "json")
        } else {
            show_alert({
                title: "تنبيه",
                body: "يجب أن تسجّل دخول لتتمكّن من التقييم",
                button_text: "إغلاق",
                action: "close"
            })
        }
    });
    $(".downvote_btn").live("click", function (m) {
        m.preventDefault();
        var k = $(this).attr("id").split("-")[1];
        var l = $("#user_token").val();
        var base_url = $("#base_url").val();
        var n = $(this).parent().parent().find(".post_points");
        if (l) {
            $.post(base_url + "/post/" + k + "/downvote", {
                _token: l
            }, function (o) {
                if (typeof o.points != "undefined") {
                    n.text(o.points).fadeOut(200).fadeIn(200)
                }
                if (o.msg) {
                    /*show_alert({
                        title: "تنبيه",
                        body: o.msg,
                        button_text: "إغلاق",
                        action: "close"
                    })*/
                    alert(o.msg);
                }
            }, "json")
        } else {
            show_alert({
                title: "تنبيه",
                body: "يجب أن تسجّل دخول لتتمكّن من التقييم",
                button_text: "إغلاق",
                action: "close"
            })
        }
    });
    
    $(".comment_upvote_btn").live("click", function (n) {
        n.preventDefault();
        var m = $(this).attr("id").split("-")[1];
        //var k = $("#post_id").val();
        var l = $("#user_token").val();
        var base_url = $("#base_url").val();
        var o = $(this).parent().parent().find(".comment_points");
        if (l) {
            $.post(base_url + "/comment/" + m + "/upvote", {
                _token: l
            }, function (p) {
                if (typeof p.points != "undefined") {
                    o.text(p.points).fadeOut(200).fadeIn(200)
                }
                if (p.msg) {
//                    show_alert({
//                        title: "تنبيه",
//                        body: p.msg,
//                        button_text: "إغلاق",
//                        action: "close"
//                    })
                      alert(p.msg);
                }
            }, "json")
        } else {
            show_alert({
                title: "تنبيه",
                body: "يجب أن تسجّل دخول لتتمكّن من التقييم",
                button_text: "إغلاق",
                action: "close"
            })
        }
    });
    $(".comment_downvote_btn").live("click", function (n) {
        n.preventDefault();
        var m = $(this).attr("id").split("-")[1];
        //var k = $("#post_id").val();
        var l = $("#user_token").val();
        var base_url = $("#base_url").val();
        var o = $(this).parent().parent().find(".comment_points");
        if (l) {
            $.post(base_url+"/comment/" + m + "/downvote", {
                _token: l
            }, function (p) {
                if (typeof p.points != "undefined") {
                    o.text(p.points).fadeOut(200).fadeIn(200)
                }
                if (p.msg) {
//                    show_alert({
//                        title: "تنبيه",
//                        body: p.msg,
//                        button_text: "إغلاق",
//                        action: "close"
//                    })
                      alert(p.msg);
                }
            }, "json")
        } else {
            show_alert({
                title: "تنبيه",
                body: "يجب أن تسجّل دخول لتتمكّن من التقييم",
                button_text: "إغلاق",
                action: "close"
            })
        }
    });
    
    comment_reset_buttons = function (k) {
        var l = $("#comment-" + k);
        l.find(".comment_unedit_btn:first").addClass("hidden");
        l.find(".comment_edit_btn:first").removeClass("hidden");
        l.find(".comment_unreply_btn:first").addClass("hidden");
        l.find(".comment_reply_btn:first").removeClass("hidden");
        l.find(".comment_wrapper:first .comment_content").removeClass("hidden")
    };
    
    $(".comment_reply_btn").live("click", function (l) {
        l.preventDefault();
        var m = $(this).parent().parent().parent().parent();
        var k = m.attr("id").split("-")[1];
        comment_reset_buttons(k);
        $("#post_comments").find("form").remove();
        $("#post_comments").find(".comment_unreply_btn").addClass("hidden");
        $("#post_comments").find(".comment_reply_btn").removeClass("hidden");
        $($("#add_comment").html()).insertAfter($("#comment-" + k).find(".comment_wrapper:first"));
        m.find("input[name=parent_id]").val(k);
        m.find("textarea[name=comment_content]").focus();
        m.find(".comment_reply_btn:first").addClass("hidden");
        m.find(".comment_unreply_btn:first").removeClass("hidden")
    });

    $(".comment_unreply_btn").live("click", function (l) {
        l.preventDefault();
        var m = $(this).parent().parent().parent().parent();
        var k = m.attr("id").split("-")[1];
        m.find("form").remove();
        comment_reset_buttons(k)
    });
    

    
    $(".comment_edit_btn").live("click", function (o) {
        
        o.preventDefault();
        var base_url = $("#base_url").val();
        var p = $(this).parent().parent().parent().parent();
        var n = p.attr("id").split("-")[1];
        
        var k = $("#comment-" + n).find(".comment_wrapper:first .comment_content");
        var l = $("#post_id").val();
        var m = $("#user_token").val();
        comment_reset_buttons(n);
        $("#post_comments").find("form").remove();
        $("#post_comments").find(".comment_unedit_btn").addClass("hidden");
        $("#post_comments").find(".comment_edit_btn").removeClass("hidden");
        k.addClass("hidden");
        $($("#add_comment").html()).insertAfter(k);
        p.find("form").attr("action", base_url+"/comment/edit/" + n );
        p.find("form").addClass("live_comment_edit_form");
        p.find("input[type=submit]").val(" تعديل التعليق ");
        //p.find("input[name=comment_parent]").val(n);
        /*if (q.comment_content) {
            p.find("textarea[name=comment_content]").val(q.comment_content);
            p.find("textarea[name=comment_content]").focus()
        }*/
        //alert(k.text());
        p.find("textarea[name=comment_content]").val($.trim(k.text()));
        p.find("textarea[name=comment_content]").focus()
        p.find(".comment_edit_btn:first").addClass("hidden");
        p.find(".comment_unedit_btn:first").removeClass("hidden")
        /*$.post("/post/" + l + "/comment_content/" + n, {
            token: m
        }, function (q) {
            $("#post_comments").find("form").remove();
            $("#post_comments").find(".comment_unedit_btn").addClass("hidden");
            $("#post_comments").find(".comment_edit_btn").removeClass("hidden");
            k.addClass("hidden");
            $($("#add_comment").html()).insertAfter(k);
            p.find("form").attr("action", "/post/" + l + "/comment_edit/" + n);
            p.find("form").addClass("live_comment_edit_form");
            p.find("input[type=submit]").val(" تعديل التعليق ");
            p.find("input[name=comment_parent]").val(n);
            if (q.comment_content) {
                p.find("textarea[name=comment_content]").val(q.comment_content);
                p.find("textarea[name=comment_content]").focus()
            }
            p.find(".comment_edit_btn:first").addClass("hidden");
            p.find(".comment_unedit_btn:first").removeClass("hidden")
        }, "json")*/
    });
    
    $(".comment_unedit_btn").live("click", function (l) {
        l.preventDefault();
        var m = $(this).parent().parent().parent().parent();
        var k = m.attr("id").split("-")[1];
        m.find("form").remove();
        comment_reset_buttons(k)
    });
    
    $("#password_btn").click(function (k) {
        k.preventDefault();
        $("#login_form_wrapper").addClass("hidden");
        $("#password_form_wrapper").removeClass("hidden")
    });
    
    $("#relogin_btn").click(function (k) {
        k.preventDefault();
        $("#password_form_wrapper").addClass("hidden");
        $("#login_form_wrapper").removeClass("hidden")
    });
    
    
    $(".category_follow_btn").live("click", function (m) {
        m.preventDefault();
        var base_url = $("#base_url").val();
        var l = $(this).parent();
        var n = $(this).attr("id").split("category-")[1];
        var k = $("#user_token").val();
        $.post(base_url + "/community/" + n + "/subscribe", {
            _token: k
        }, function (o) {
            if (o.success) {
                l.find(".category_follow_btn").addClass("hidden");
                l.find(".category_unfollow_btn").removeClass("hidden")
            }
        }, "json")
    });
    $(".category_unfollow_btn").live("click", function (m) {
        m.preventDefault();
        var base_url = $("#base_url").val();
        var l = $(this).parent();
        var n = $(this).attr("id").split("category-")[1];
        var k = $("#user_token").val();
        $.post(base_url + "/community/" + n + "/unsubscribe", {
            _token: k
        }, function (o) {
            if (o.success) {
                l.find(".category_unfollow_btn").addClass("hidden");
                l.find(".category_follow_btn").removeClass("hidden")
            }
        }, "json")
    });
    
    $('#community_form input[name="community_slug"]').change(function (k) {
        if ($(this).val().length < 3) {
            alert("لا يمكن أن يكون الاسم القصير للمجتمع مؤلفاً من أقل من 3 أحرف.");
            $(this).val("");
            $("#community_form .community_slug_example").text("example")
        } else {
            if (!(/^[A-Za-z0-9][A-Za-z0-9_]*[A-Za-z0-9]$/.test($(this).val()))) {
                alert("فقط الأحرف الانجليزية A-Z مع أرقام 0-9 و _ بالوسط مسموحة.");
                $(this).val("");
                $("#community_form .community_slug_example").text("example")
            } else {
                $("#community_form .community_slug_example").text($(this).val())
            }
        }
    });

    function j(l) {
        l = typeof l !== "undefined" ? l : 200;
        var k = l - $("#community_form textarea[name='community_description']").val().length;
        $("#community_form #community_description_chars").text(k);
        if (k < 0) {
            $("#community_form #community_description_chars").addClass("red")
        } else {
            $("#community_form #community_description_chars").removeClass("red")
        }
    }
    $("#community_form textarea[name='community_description']").keyup(function () {
        j()
    });
    if ($("#community_form textarea[name='community_description']").length) {
        j()
    }
    
    
    $("#category_follow_btn").live("click", function (l) {
        l.preventDefault();
        var m = $("#community_id").val();
        var base_url = $("#base_url").val();
        var k = $("#user_token").val();
        $.post(base_url + "/community/" + m + "/subscribe", {
            _token: k
        }, function (n) {
            if (n.success) {
                $("#category_follow_btn").addClass("hidden");
                $("#category_unfollow_btn").removeClass("hidden")
            }
        }, "json")
    });
    $("#category_unfollow_btn").live("click", function (l) {
        l.preventDefault();
        var m = $("#community_id").val();
        var base_url = $("#base_url").val();
        var k = $("#user_token").val();
        $.post(base_url + "/community/" + m + "/unsubscribe", {
            _token: k
        }, function (n) {
            if (n.success) {
                $("#category_unfollow_btn").addClass("hidden");
                $("#category_follow_btn").removeClass("hidden")
            }
        }, "json")
    });
    
    $(".media_show_button").live("click", function (l) {
        
        l.preventDefault();
        var youtubeEmbed = '<br><iframe width="600" height="350"  src="//www.youtube.com/embed/%mediaId%" frameborder="0" allowfullscreen></iframe>';
        var vimeoEmbed = '<br><iframe src="//player.vimeo.com/video/%mediaId%?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" width="600" height="350"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        var imgurEmbed = '<br><iframe width="600" height="350"  src="//i.imgur.com/%mediaId%.%mediaExt%" frameborder="0"></iframe>';
        
        var postId = $(this).parent().parent().attr("id").split("-")[1];
        
        var media_type = $(this).children(0).attr('media-type');
        var media_id = $(this).children(0).attr('media-id');
        var media_ext = $(this).children(0).attr('media-ext');
        
        var embedCode = "";
        if (media_type == "VIDEO.YOUTUBE") embedCode= youtubeEmbed ;
        else if (media_type == "VIDEO.VIMEO") embedCode= vimeoEmbed ;
        else if (media_type == "IMAGE.IMGUR") embedCode= imgurEmbed ;
        
        embedCode = embedCode.replace('%mediaId%',media_id);
        embedCode = embedCode.replace('%mediaExt%',media_ext);
        
        
        $('#player_container-' + postId).toggle();
        $('#player_container-' + postId).filter(":visible").html(embedCode);
        if ($('#player_container-' + postId).is(":visible")) 
        {
            $(this).children(0).removeClass("fa fa-youtube-play").addClass("fa fa-minus-square-o");
        }else
        {
            $(this).children(0).removeClass("fa fa-minus-square-o").addClass("fa fa-youtube-play");
        }
    });
    
    $(".add_favorite").live("click", function (n) {
        n.preventDefault();
        var k = $(this).parent();
        var l = k.attr("id").split("-")[1];
        var m = $("#user_token").val();
        var base_url = $("#base_url").val();
        $.post(base_url + "/favorites/add", {
            post_id: l,
            _token: m
        }, function (o) {
            if (o.success) {
                k.find(".add_favorite").addClass("hidden");
                k.find(".remove_favorite").removeClass("hidden")
            }
        }, "json")
    });
    $(".remove_favorite").live("click", function (n) {
        n.preventDefault();
        var k = $(this).parent();
        var l = k.attr("id").split("-")[1];
        var m = $("#user_token").val();
        var base_url = $("#base_url").val();
        $.post(base_url +"/favorites/remove", {
            post_id: l,
            _token: m
        }, function (o) {
            if (o.success) {
                k.find(".remove_favorite").addClass("hidden");
                k.find(".add_favorite").removeClass("hidden")
            }
        }, "json")
    });
    
    $(".post_report_spam").live("click", function (m) {
        m.preventDefault();
        var k = $("#post_id").val();
        var l = $("#user_token").val();
        var base_url = $("#base_url").val();
        $.post(base_url + "/flag/spam/post", {
            post_id: k,
            _token: l
        }, function (n) {
            if (n.msg) {
                    alert(n.msg);
                }
        }, "json")
    });
    
    $(".comment_report_spam").live("click", function (m) {
        m.preventDefault();
        var p = $(this).parent().parent().parent().parent();
        var n = p.attr("id").split("-")[1];
        
        var l = $("#user_token").val();
        var base_url = $("#base_url").val();
        $.post(base_url + "/flag/spam/comment", {
            comment_id: n,
            _token: l
        }, function (n) {
            if (n.success) {
                if (n.msg) {
                    alert(n.msg);
                }
            }
        }, "json")
    });
    
    /*jQuery.fn.show_dialog = function () {
        $("#shadow_box").css("display", "inline");
        this.css("display", "inline");
        this.css("position", "fixed");
        this.css("top", "20%");
        this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
        this.css("min-width", ($("#dialog_form").width() + 1) + "px");
        return this
    };
    close_dialog = function () {
        $("#shadow_box").css("display", "none");
        $("#dialog_form").css("display", "none");
        $("#dialog_form").css("min-width", "250px")
    };
    $(document).keyup(function (k) {
        if (k.keyCode == 27) {
            close_dialog()
        }
    });
    $(".close_dialog_btn").live("click", function (k) {
        k.preventDefault();
        close_dialog()
    });
    $(".redirect_dialog_btn").live("click", function (k) {
        k.preventDefault();
        window.location = $(this).attr("id");
        close_dialog()
    });
    $(".reload_dialog_btn").live("click", function (k) {
        k.preventDefault();
        close_dialog();
        location.reload()
    });
    show_alert = function (k) {
        $("#dialog_form #dialog_title").text(k.title);
        $("#dialog_form #dialog_body").html("<p>" + k.body + "</p>");
        if (k.action === "reload") {
            $("#dialog_form #dialog_buttons").html('<a href="#" class="reload_dialog_btn button">' + k.button_text + "</a>")
        } else {
            if (k.action === "redirect") {
                $("#dialog_form #dialog_buttons").html('<a id="' + k.redirect_url + '" href="#" class="redirect_dialog_btn button">' + k.button_text + "</a>")
            } else {
                $("#dialog_form #dialog_buttons").html('<a href="#" class="close_dialog_btn button">' + k.button_text + "</a>")
            }
        }
        $("#dialog_form").show_dialog()
    };
    $("form").live("submit", function () {
        $("#io_input").val("")
    });
    $(".replace_urls").replace_urls();
    $(".category-select2").select2({
        placeholder: "اختر المجتمع المناسب لهذا الموضوع",
        matcher: function (l, m, k) {
            return m.indexOf(l) >= 0 || k.attr("alt").indexOf(l) >= 0
        },
        formatNoMatches: function () {
            return "لم يتم العثور على هذا المجتمع"
        }
    });
    reset_screen_height = function () {
        var l = 620;
        var k = ($(window).height() * l) / $(window).width();
        if (k) {
            $("html").css("height", k + "px");
            $("body").css("height", k + "px")
        }
    };
    if ($("#signup_overlay_wrapper").length) {
        if ($(window).width() < 620) {
            reset_screen_height()
        }
    }
    $(window).on("orientationchange", function () {
        if ($(window).width() < 620) {
            reset_screen_height()
        } else {
            $("html").css("height", "100%");
            $("body").css("height", "100%")
        }
    });
    centralised_elements = function (p, o) {
        var l = $(p).width();
        var n = 0;
        var m = 0;
        var k = 0;
        jQuery.each($(p + " " + o), function () {
            n += $(this).width();
            m += 1
        });
        k = parseInt((l - n) / (m - 1));
        jQuery.each($(p + " " + o), function () {
            if (m > 1) {
                $(this).css("margin-left", k + "px")
            }
            m -= 1
        })
    };
    centralised_elements("#nav", "a");
    io_menu_is_visible = function () {
        if ($("#menu:visible").length) {
            if (window.pageYOffset > $("#menu").innerHeight()) {
                return false
            } else {
                return true
            }
        } else {
            return false
        }
    };
    fixed_header = function () {
        $("#header").addClass("fixed_top");
        $("#content").addClass("fixed_top")
    };
    unfixed_header = function () {
        $("#header").removeClass("fixed_top");
        $("#content").removeClass("fixed_top")
    };
    show_full_width_comments = function () {
        $(".post_comment").each(function (m, o) {
            var n = $("#page").width();
            var l = false;
            var k = 21;
            if ($("#post_sidebar:visible").length) {
                if ($(o).offset().top > $("#post_sidebar").offset().top + $("#post_sidebar").height()) {
                    l = true
                }
            } else {
                l = true
            } if ($(o).hasClass("autowidth")) {
                l = false
            }
            if (l) {
                for (i = 1; i <= 20; i++) {
                    if ($(o).hasClass("index" + i)) {
                        n -= k * i
                    }
                }
                $(o).css("width", n + "px")
            } else {
                $(o).css("width", "auto")
            }
        })
    };
    show_full_width_comments();
    if ($("body").width() <= 800) {
        fixed_header()
    } else {
        $(window).on("scroll", function () {
            if (io_menu_is_visible()) {
                unfixed_header()
            } else {
                fixed_header()
            }
        })
    }
    $(window).on("resize orientationchange", function () {
        show_full_width_comments();
        if (io_menu_is_visible()) {
            unfixed_header();
            centralised_elements("#nav", "a")
        } else {
            fixed_header()
        }
    });
    
    
    $("#invite_signup_form").submit(function () {
        var n = $("#invite_signup_form").find("input[name=username]");
        var m = $("#invite_signup_form").find("input[name=email_address]");
        var k = $("#invite_signup_form").find("input[name=password]");
        var l = $("#invite_signup_form").find("input[name=invite_token]");
        $.post("/signup", {
            username: n.val(),
            email_address: m.val(),
            password: k.val(),
            invite_token: l.val()
        }, function (o) {
            if (o.msg) {
                show_alert({
                    title: "تنبيه",
                    body: o.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
            if (o.logged_in) {
                window.location = "/account"
            }
            if (o.success) {
                m.val("");
                k.val("")
            }
        }, "json");
        return false
    });
    $("#signup_form").submit(function () {
        var n = $("#signup_form").find("input[name=username]");
        var m = $("#signup_form").find("input[name=email_address]");
        var k = $("#signup_form").find("input[name=password]");
        var l = $("#signup_form").find("input[name=follow_category]");
        $.post("/signup", {
            username: n.val(),
            email_address: m.val(),
            password: k.val(),
            follow_category: l.val()
        }, function (o) {
            if (o.msg) {
                show_alert({
                    title: "تنبيه",
                    body: o.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
            if (o.logged_in) {
                location.reload()
            }
            if (o.success) {
                $("#login_form").find("input[name=username]").val(n.val());
                n.val("");
                m.val("")
            }
            k.val("")
        }, "json");
        return false
    });
    $("#invite_request_form").submit(function () {
        var k = $("#invite_request_form").find("input[name=email_address]");
        $.post("/invite_request", {
            email_address: k.val()
        }, function (l) {
            if (l.msg) {
                show_alert({
                    title: "تنبيه",
                    body: l.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
            if (l.success) {
                k.val("")
            }
        }, "json");
        return false
    });
    $("#login_form").submit(function () {
        var m = $("#login_form").find("input[name=username]");
        var k = $("#login_form").find("input[name=password]");
        var l = $("#login_form").find("input[name=follow_category]");
        $.post("/login", {
            username: m.val(),
            password: k.val(),
            follow_category: l.val()
        }, function (n) {
            if (n.msg) {
                show_alert({
                    title: "تنبيه",
                    body: n.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
            if (n.success || n.logged_in) {
                location.reload()
            } else {
                k.val("")
            }
        }, "json");
        return false
    });
    $("#password_form").submit(function () {
        var k = $("#password_form").find("input[name=email_address]");
        $.post("/password", {
            email_address: k.val()
        }, function (l) {
            if (l.msg) {
                show_alert({
                    title: "تنبيه",
                    body: l.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
            k.val("")
        }, "json");
        return false
    });
    $("#change_password_btn").live("click", function (k) {
        k.preventDefault();
        $("#change_password").toggle("fast").removeClass("hidden")
    });
    $(".reactivate_email_btn").live("click", function (l) {
        l.preventDefault();
        var k = $(this).attr("id");
        if (!ajax_loading) {
            $.post("/signup/reactivate", {
                user_token: k
            }, function (m) {
                if (m.msg) {
                    show_alert({
                        title: "تنبيه",
                        body: m.msg,
                        button_text: "إغلاق",
                        action: "close"
                    })
                }
            }, "json")
        }
    });
    $("#preview_post_btn").live("click", function (m) {
        m.preventDefault();
        var n = $("#post_title").val();
        var l = $("#post_content").val();
        var k = $("#user_token").val();
        if (!n) {
            show_alert({
                title: "تنبيه",
                body: "لم تدخل أي عنوان بعد",
                button_text: "إغلاق",
                action: "close"
            });
            $("#post_title").focus()
        } else {
            if (!l) {
                show_alert({
                    title: "تنبيه",
                    body: "محتوى الموضوع مازال فارغاً",
                    button_text: "إغلاق",
                    action: "close"
                });
                $("#post_content").focus()
            } else {
                $.post("/add/post/preview", {
                    content: l,
                    token: k
                }, function (o) {
                    if (o.rendered) {
                        $("#preview_post_title").text(n).html();
                        $("#preview_post").removeClass("hidden");
                        $("#preview_post_content").html(o.rendered);
                        $("#preview_post_content").replace_urls();
                        $("html, body").animate({
                            scrollTop: ($("#preview_post").offset().top - 100)
                        }, 1000)
                    }
                }, "json")
            }
        }
    });
    $("#format_post_btn").live("click", function (k) {
        $("#format_post").toggle("fast");
        $("#format_post").removeClass("hidden")
    });
    get_link_remote_data = function () {
        var k = $("#add #page_content input[name='url']").attr("value");
        var l = $("#user_token").val();
        if (k) {
            $.post("/ajax/add/link_data", {
                url: k,
                token: l
            }, function (m) {
                if (m.title) {
                    $("#add #page_content input[name='title']").val(m.title)
                }
                if (m.images && m.images.length > 0) {
                    $("#add #page_content #new_post_images").removeClass("hidden");
                    if (m.images.length > 1) {
                        $("#add #page_content #new_post_images #new_post_image_selected").addClass("hidden");
                        $("#add #page_content #new_post_images #new_post_images_select").removeClass("hidden")
                    } else {
                        $("#add #page_content #new_post_images #new_post_images_select").addClass("hidden");
                        $("#add #page_content #new_post_images #new_post_image_selected").removeClass("hidden")
                    }
                    $("#add #page_content #new_post_images #post_images").html("");
                    $.each(m.images, function (n, o) {
                        $("#add #page_content #new_post_images #post_images").append('<div class="new_post_thumbnail nailthumb-container square-thumb"><img src="' + o + "\" onerror=\"this.style.display = 'none';this.parentNode.style.display = 'none'\" /></div>")
                    });
                    $(".nailthumb-container").nailthumb();
                    if ($(".new_post_thumbnail:visible").length > 0) {
                        $(".new_post_thumbnail:visible:first").addClass("selected_thumb");
                        $("#add #page_content input[name='post_image']").val($(".new_post_thumbnail:visible:first").find("img").attr("src"))
                    } else {
                        $("#add #page_content #new_post_images #new_post_images_select").addClass("hidden");
                        $("#add #page_content #new_post_images #new_post_image_selected").addClass("hidden");
                        $("#add #page_content #new_post_images").addClass("hidden");
                        $("#add #page_content input[name='post_image']").val("")
                    }
                } else {
                    $("#add #page_content #new_post_images").addClass("hidden");
                    $("#add #page_content input[name='post_image']").val("")
                }
            }, "json")
        }
    };
    if ($("#add #page_content input[name='url']").length) {
        get_link_remote_data()
    }
    $("#add #page_content input[name='url']").change(function () {
        get_link_remote_data()
    });
    $(".new_post_thumbnail").live("click", function (k) {
        k.preventDefault();
        $(".new_post_thumbnail").removeClass("selected_thumb");
        $(this).addClass("selected_thumb");
        $("#add #page_content input[name='post_image']").val($(this).find("img").attr("src"))
    });
    $("#search_form").live("submit", function (l) {
        var k = $("#search_form").find("input[name=s]");
        if (k.val().length < 3) {
            l.preventDefault();
            show_alert({
                title: "تنبيه",
                body: "كلمة البحث التي أدخلتها قصيرة جداً. 3 أحرف هو الحد الأدنى.",
                button_text: "إغلاق",
                action: "close"
            })
        }
    });
    $(".add_favorite").live("click", function (n) {
        n.preventDefault();
        var k = $(this).parent();
        var l = k.attr("id").split("-")[1];
        var m = $("#user_token").val();
        $.post("/favorites/add", {
            post_id: l,
            token: m
        }, function (o) {
            if (o.success) {
                k.find(".add_favorite").addClass("hidden");
                k.find(".remove_favorite").removeClass("hidden")
            }
        }, "json")
    });
    $(".remove_favorite").live("click", function (n) {
        n.preventDefault();
        var k = $(this).parent();
        var l = k.attr("id").split("-")[1];
        var m = $("#user_token").val();
        $.post("/favorites/remove", {
            post_id: l,
            token: m
        }, function (o) {
            if (o.success) {
                k.find(".remove_favorite").addClass("hidden");
                k.find(".add_favorite").removeClass("hidden")
            }
        }, "json")
    });
    
    $("#category_follow_signup_btn").live("click", function (k) {
        var l = $("#category_slug").val();
        $("#signup_form_wrapper #signup_form input[name='follow_category']").val(l);
        $("#login_form_wrapper #login_form input[name='follow_category']").val(l)
    });
    
    
    $(".category_follow_interest_btn").live("click", function (o) {
        o.preventDefault();
        var n = $(this).parent();
        var k = n.parent().parent();
        var p = $(this).attr("id").split("category-")[1];
        var m = $("#user_token").val();
        var l = [];
        k.find("a").each(function () {
            l.push(this.id.split("-")[1])
        });
        jQuery.unique(l);
        $.post("/" + p + "/follow", {
            "category_slugs[]": l,
            interest: true,
            token: m
        }, function (q) {
            if (q.success) {
                if (q.html_replace) {
                    n.parent().fadeOut("fast", function () {
                        n.parent().replaceWith(q.html_replace)
                    })
                } else {
                    n.parent().fadeOut("fast")
                }
            }
        }, "json")
    });
    $(".category_nointerest_btn").live("click", function (o) {
        o.preventDefault();
        var n = $(this).parent();
        var k = n.parent().parent();
        var p = $(this).attr("id").split("category-")[1];
        var m = $("#user_token").val();
        var l = [];
        k.find("a").each(function () {
            l.push(this.id.split("-")[1])
        });
        jQuery.unique(l);
        $.post("/" + p + "/nointerest", {
            "category_slugs[]": l,
            token: m
        }, function (q) {
            if (q.success) {
                if (q.html_replace) {
                    n.parent().fadeOut("fast", function () {
                        n.parent().replaceWith(q.html_replace)
                    })
                } else {
                    n.parent().fadeOut("fast")
                }
            }
        }, "json")
    });

    function a() {
        loading_content = true;
        $("#loadmore_btn").val("يرجى الانتظار...");
        $("#loadmore_btn").attr("disabled", true);
        var k = $("#page_url").val().replace(/(\/)/, "");
        if ($("#search_term").length) {
            var o = $("#search_term").val()
        } else {
            var o = ""
        }
        var l = [];
        $("#posts .post").each(function () {
            l.push(this.id.split("-")[1])
        });
        jQuery.unique(l);
        var m = [];
        $("#comments .comment").each(function () {
            m.push(this.id.split("-")[1])
        });
        jQuery.unique(m);
        var n = [];
        $("#questions .question").each(function () {
            n.push(this.id.split("-")[1])
        });
        jQuery.unique(n);
        $.post("/load_more/", {
            search_term: o,
            load_url: k,
            "post_ids[]": l,
            "comment_ids[]": m,
            "question_ids[]": n
        }, function (p) {
            if (p.count < 25) {
                $("#more_content").fadeOut(100);
                $("#loadmore_btn").removeClass("loadmore_auto")
            }
            if ($("#posts").length) {
                $("#posts").append(p.content);
                $(".nailthumb-container").nailthumb({
                    replaceAnimation: null
                })
            } else {
                if ($("#comments").length) {
                    $("#comments").append(p.content)
                } else {
                    if ($("#questions").length) {
                        $("#questions").append(p.content)
                    }
                }
            }
            $("#loadmore_btn").val("عرض المزيد");
            $("#loadmore_btn").attr("disabled", false);
            loading_content = false
        }, "json")
    }
    if ($("#loadmore_btn").length) {
        $(window).scroll(function () {
            if ($(".loadmore_auto").length) {
                var k = $(".loadmore_auto").offset().top - $(window).height();
                if (($(window).scrollTop() > k) && (!loading_content)) {
                    a()
                }
            }
        })
    }
    $("#loadmore_btn").live("click", function (k) {
        k.preventDefault();
        $("#loadmore_btn").addClass("loadmore_auto");
        a()
    });
    */
    
    /*
    
    $(".short_url").live("focus", function (k) {
        $(this).select();
        $(this).mouseup(function () {
            $(this).unbind("mouseup");
            return false
        })
    });

    function h(k) {
        $(k).find(".comment_reply").removeClass("hidden");
        $(k).find(".comment_edit").removeClass("hidden");
        $(k).find(".comment_short_url").removeClass("hidden");
        $(k).find(".comment_share").removeClass("hidden")
    }

    function g(k) {
        $(k).find(".comment_reply").addClass("hidden");
        $(k).find(".comment_edit").addClass("hidden");
        $(k).find(".comment_short_url").addClass("hidden");
        $(k).find(".comment_share").addClass("hidden")
    }
    if ("ontouchstart" in document.documentElement) {
        $(".comment_wrapper").each(function () {
            h(this);
            $(".comment_share").each(function () {
                $(this).addClass("hidden")
            })
        })
    } else {
        $(".comment_wrapper").live("mouseover mouseleave", function (k) {
            if (k.type == "mouseover") {
                h(this)
            } else {
                g(this)
            }
        })
    }
    
    
    
    $(".live_comment_edit_form").live("submit", function (o) {
        o.preventDefault();
        var k = $(this).find("textarea[name=comment_content]").val();
        var p = $(this).parent().parent();
        var n = p.attr("id").split("-")[1];
        var l = $("#post_id").val();
        var m = $("#user_token").val();
        $.post("/post/" + l + "/comment_edit/" + n, {
            comment_content: k,
            token: m
        }, function (q) {
            if (q.msg) {
                show_alert({
                    title: "تنبيه",
                    body: q.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
            if (q.success) {
                comment_reset_buttons(n);
                p.find(".comment_wrapper:first .comment_content").html(q.comment_content_html).removeClass("hidden");
                p.find("form").remove()
            }
        }, "json")
    });
    $(".comment_short_url").click(function (k) {
        k.preventDefault();
        show_alert({
            title: "انسخ هذا الرابط:",
            body: '<input type="text" class="short_url inputtext ltr" style="width:250px" value="' + $(this).find("a").attr("href") + '" readonly="readonly"/>',
            button_text: "إغلاق",
            action: "close"
        })
    });
    $(".ask_question_form").submit(function (l) {
        var m = $(this).find(".captcha_required");
        if (m.length) {
            var k = ($(this).find(".captcha_required").length && m.hasClass("hidden"));
            if (k) {
                l.preventDefault();
                m.removeClass("hidden")
            }
        } else {
            if (!confirm("هل أنت متأكد من رغبتك بارسال السؤال؟")) {
                l.preventDefault()
            }
        }
    });
    $(".message_delete").click(function (m) {
        m.preventDefault();
        var n = $("#message_id").val();
        var k = $("#message_type").val();
        var l = $("#user_token").val();
        if (n && l) {
            if (confirm("هل أنت متأكد من رغبتك بحذف هذه الرسالة؟ الحذف نهائي ولا يمكن التراجع عنه")) {
                $.post("/messages/delete", {
                    message_id: n,
                    message_type: k,
                    token: l
                }, function (o) {
                    if (o.success) {
                        if (k == "sent") {
                            window.location = "/messages/sent"
                        } else {
                            window.location = "/messages"
                        }
                    }
                }, "json")
            }
        }
    });
    $(".message_mark_spam").click(function (m) {
        m.preventDefault();
        var n = $("#message_id").val();
        var k = $("#message_type").val();
        var l = $("#user_token").val();
        if (n && l) {
            if (confirm("هل أنت متأكد من رغبتك بالتبليغ عن هذه الرسالة؟")) {
                $.post("/messages/report", {
                    message_id: n,
                    message_type: k,
                    token: l
                }, function (o) {
                    if (o.success) {
                        location.reload()
                    }
                }, "json")
            }
        }
    });
    if ($("#page #messages #new_message_form").length) {
        var b = $("#page #messages #new_message_form input[name='username']");
        var c = $("#user_token").val();
        var d;
        var f = function () {
            $.post("/messages/new/username", {
                username: b.val(),
                token: c
            }, function (k) {
                if (k.success) {
                    $("#new_message_user_details #user_url #user_image").attr("src", k.user_image);
                    $("#new_message_user_details #user_url").attr("href", k.user_url);
                    $("#new_message_user_details").removeClass("hidden")
                } else {
                    show_alert({
                        title: "تنبيه",
                        body: "اسم المستخدم الذي أدخلته غير معروف",
                        button_text: "إغلاق",
                        action: "close"
                    });
                    $("#new_message_user_details").addClass("hidden");
                    $("#new_message_user_details #user_url #user_image").removeAttr("src");
                    $("#new_message_user_details #user_url").removeAttr("href")
                }
            }, "json")
        };
        b.change(function () {
            clearTimeout(d);
            if (b.val() != "") {
                d = setTimeout(function () {
                    f()
                }, 1000)
            }
        });
        if (b.val() != "") {
            f()
        }
    }
    if ($("#message #page_content").length) {
        $("#message #page_content p:contains('---'):contains('أرسلها'):contains('بتاريخ')").addClass("message_date")
    }
    $("#allow_messages_input").change(function () {
        if ($(this).attr("checked")) {
            $("#email_messages_input").attr("checked", "checked");
            $("#email_messages_input").removeAttr("disabled")
        } else {
            $("#email_messages_input").removeAttr("checked");
            $("#email_messages_input").attr("disabled", "disabled")
        }
    });
    $("#allow_questions_input").change(function () {
        if ($(this).attr("checked")) {
            $("#visitor_questions_input").removeAttr("disabled");
            $("#visitor_questions_input").attr("checked", "checked");
            $("#email_questions_input").attr("checked", "checked");
            $("#email_questions_input").removeAttr("disabled")
        } else {
            $("#visitor_questions_input").removeAttr("checked");
            $("#visitor_questions_input").attr("disabled", "disabled");
            $("#email_questions_input").removeAttr("checked");
            $("#email_questions_input").attr("disabled", "disabled")
        }
    });
    $(".question, #question").live("mouseover mouseleave", function (k) {
        if (k.type == "mouseover") {
            $(this).find(".delete_question_btn").removeClass("hidden")
        } else {
            $(this).find(".delete_question_btn").addClass("hidden")
        }
    });
    $(".answer_question_btn").live("click", function (m) {
        m.preventDefault();
        if ($("#question_id").length) {
            var k = $("#question_id").val();
            $("#answer_question").find("input[name=question_id]").val(k);
            $("#question_answer").html($("#answer_question").html());
            $("#question_answer").find("textarea[name=answer_content]").focus()
        } else {
            var l = $(this).parent().parent();
            var k = l.attr("id").split("-")[1];
            $("#answer_question").find("input[name=question_id]").val(k);
            l.find(".question_answer_content").html($("#answer_question").html());
            l.find("textarea[name=answer_content]").focus()
        }
    });
    $(".delete_question_btn").live("click", function (n) {
        n.preventDefault();
        if ($("#question_id").length) {
            var k = $("#question_id").val();
            var l = null
        } else {
            var l = $(this).parent().parent();
            var k = l.attr("id").split("-")[1]
        }
        var m = $("#user_token").val();
        if (confirm("هل أنت متأكد من رغبتك بحذف هذا السؤال؟")) {
            $.post("/questions/delete", {
                question_id: k,
                token: m
            }, function (o) {
                if (o.success) {
                    if (l) {
                        l.fadeOut(300);
                        if ($("#pending_questions").length) {
                            var p = parseInt($("#pending_questions").text());
                            p -= 1;
                            if (p < 1) {
                                $("#pending_questions").fadeOut(200)
                            } else {
                                $("#pending_questions").text(p)
                            }
                        }
                    } else {
                        location.href = "/questions"
                    }
                }
            }, "json")
        }
    });
    $(".answer_question_form").live("submit", function (n) {
        n.preventDefault();
        var m = $(this);
        var k = m.find("input[name=question_id]").val();
        var o = m.find("textarea[name=answer_content]").val();
        var l = $("#user_token").val();
        $.post("/questions/answer", {
            question_id: k,
            answer_content: o,
            token: l
        }, function (p) {
            if (p.success) {
                m.parent().parent().find(".answer_question_btn").addClass("hidden");
                m.html(p.content);
                if ($("#pending_questions").length) {
                    var q = parseInt($("#pending_questions").text());
                    q -= 1;
                    if (q < 1) {
                        $("#pending_questions").fadeOut(200)
                    } else {
                        $("#pending_questions").text(q)
                    }
                }
            }
            if (p.msg) {
                show_alert({
                    title: "تنبيه",
                    body: p.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
        }, "json")
    });
    $("#dropdown-notifications").on("show", function (m, l) {
        var k = $("#user_token").val();
        var n = [];
        $(".mnotification.highlight").each(function () {
            n.push(this.id.split("-")[1])
        });
        jQuery.unique(n);
        $.post("/notifications/viewed", {
            "mnotification_ids[]": n,
            token: k
        }, function (o) {
            if (o.success) {}
            if (o.msg) {
                show_alert({
                    title: "تنبيه",
                    body: o.msg,
                    button_text: "إغلاق",
                    action: "close"
                })
            }
        }, "json");
        $("#notifications_btn .upper_count").addClass("hidden")
    });
    
    $("input.tagit").each(function () {
        $(this).tagit({
            caseSensitive: false,
            fieldName: "topics",
            tagLimit: 5,
            animate: false,
            singleField: true,
            autocomplete: {
                source: "/ajax/add/topics",
                delay: 0,
                minLength: 2
            }
        })
    });
    if ($("#community_form input[name='community_type']").length) {
        $("#community_form input[name='community_type']").change(function () {
            if ($("#community_form input[name='community_type']:checked").val() === "private") {
                $("#private_community_options").removeClass("hidden")
            } else {
                $("#private_community_options").addClass("hidden")
            }
        });
        if ($("#community_form input[name='community_type']:checked").val() === "private") {
            $("#private_community_options").removeClass("hidden")
        }
    }
    if ($("#community_image_uploader").length) {
        var e = new qq.FileUploader({
            element: $("#community_image_uploader")[0],
            action: "/communities/create/upload",
            params: {
                token: $("#user_token").val()
            },
            allowedExtensions: ["jpg", "jpeg", "png", "gif"],
            sizeLimit: 204800,
            multiple: false,
            debug: true,
            onSubmit: function (l, k) {
                e.setParams({
                    token: $("#user_token").val()
                })
            },
            onComplete: function (m, k, l) {
                if (l.success) {
                    $("#community_logo_preview").removeClass("hidden");
                    $("#community_logo_preview").attr("src", l.image);
                    $("#community_logo").val(l.image)
                } else {
                    show_alert({
                        title: "خطأ",
                        body: l.error,
                        button_text: "إغلاق",
                        action: "close"
                    })
                }
            },
            messages: {
                typeError: "صيغة الملف {file} خاطئة. يسمح بالصيغ التالية فقط {extensions}.",
                sizeError: "حجم الصورة {file} أكبر من المسموح. الحد الأقصى {sizeLimit}.",
                emptyError: "الملف {file} فارغ!",
                onLeave: "يتم رفع الصورة الآن. إغلاقك للصفحة سيوقف الرفع."
            },
            template: '<div class="qq-uploader"><div class="qq-upload-drop-area"><span></span></div><div class="qq-upload-button button">اختيار</div><ul class="qq-upload-list"></ul></div>',
        })
    }
    if ($("#community_logo_preview").length && $("#community_logo").length) {
        if ($("#community_logo").val() != "") {
            $("#community_logo_preview").removeClass("hidden");
            $("#community_logo_preview").attr("src", $("#community_logo").val())
        }
    }
    
    */
});