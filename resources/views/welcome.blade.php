<?php
    $appVersion = config('app.version');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="docs/css/style.css"/>
    <script src="docs/js/all.js"></script>


    <script>
        $(function () {
            setupLanguages(["bash", "javascript"]);
        });
    </script>
</head>

<body class="">
<a href="#" id="nav-button">
      <span>
        NAV
        <img src="docs/images/navbar.png"/>
      </span>
</a>
<div class="tocify-wrapper">
    <img style="max-width: 100%" src="docs/images/logo.png"/>
    <div class="lang-selector">
        <a href="#" data-language-name="bash">bash</a>
        <a href="#" data-language-name="javascript">javascript</a>
    </div>
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>
    <div id="toc">
    </div>
    <ul class="toc-footer">
        <li><a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a></li>
    </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <!-- START_INFO -->
        <h1>Info v(<?= $appVersion ?>)</h1>
        <p>
            Welcome to the API reference.
            <a href="docs/collection.json">Get Postman Collection</a>.
            Here you can find API endpoints with examples how to use them
        </p>
        <!-- END_INFO -->
        <h1>API Endpoints</h1>
        <!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
        <h2>Get auth_token for user</h2>
        <p>
            Throw this request you are able to send user credentials ( email, password ) and get
            auth_token for user.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre>
    <code class="language-bash">
        curl -X POST "http://localhost/api/login" \-H "Accept: application/json"
    </code>
</pre>
        <pre>
    <code class="language-javascript">
    var settings = {
        "data":{
            "email":{string},
            "password":{string}
        }
        "url": "http://localhost/api/login",
        "method": "POST",
        "headers": {
            "accept": "application/json"
        }
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
    </code>
</pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE1NjgyZDAyZGY1NjBjODZlNTEyYjljNjZiNDYxNGY5ZDhhZTY0MTNlY2NlZjQwMTE3ODc5MmYwYTYzOTliNTczYmNiNWE2N2FlMmYyNmRjIn0.eyJhdWQiOiIxIiwianRpIjoiYTU2ODJkMDJkZjU2MGM4NmU1MTJiOWM2NmI0NjE0ZjlkOGFlNjQxM2VjY2VmNDAxMTc4NzkyZjBhNjM5OWI1NzNiY2I1YTY3YWUyZjI2ZGMiLCJpYXQiOjE0OTgzOTg4ODcsIm5iZiI6MTQ5ODM5ODg4NywiZXhwIjoxNTI5OTM0ODg3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oZ8VMs-uqzGEpgnRfUc4m6pjEBPkOr4Fks5o6jlyoimpc0HYEWB-RzkXlWaDisKa5rKkjGwTOYJhCsNWWmjR2Rane8dio8k8Ck-cprWob08Zw-xXt90OMxBetijd0cv1rhqR8VeEGyNjjk_GMbRP4EjjbEdwFjNNRgxxEC2fFPqAXJn1u1XXW-r2EKL8NYfyADlLCSsLJ_psM_XCGvfb4myzjqTtCWIkXfs2_xX4Ah28KzwY_7E5U29WQZhR0ptAVvkVugCRGOqeOFE3tn5rFUpHiAwu484gDS-7uouyxNoMngRzoimJYCbY4oWQs7o3ZwKO8BdjYAch7a0tYY4_9KwLFrlLJRANN1uhWc2UTioWKVBCZLjdInxVz7Nvd6f7-T-PudLo3dx2g-bIM2ju0lLm6L8lxejtpW4RHXYYWnLDZHAfPTk33ql3K89EOF5F0u3PgnFAUiDFxXYuzmHfpM2JUE3D9xlfgKw_WlBG1Pl9JQCh0CmGgFzIYrQBlOocvSX3khPn15twovxk5kK2ASmpNL_XVGnBmiwNPzo-W2UCtAnJczkzR3qSv5kYKYTQocKcB5phgdsF89fhUQT5Xf-t6l1hUlRrwT5T0uhwVND_Cz6S9X_IbOPPgE9YFVj7EtGBUjl1jgB5HplsV9heOJnfGmZ1ZVR186ktVg1AiT0"
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                email: required|email <br/>
                password: required|string
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/login</code></p>
        <p>Store token from response for feature use.</p>
        <!-- START CHANGE STATUS-->
        <h2>Change user status</h2>
        <p>
            This request will make it possible for admins to change statuses of their users.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre>
    <code class="language-bash">
        curl -X POST "http://localhost/api/user/change-status" \-H "Accept: application/json"
    </code>
</pre>
        <pre>
    <code class="language-javascript">
    var settings = {
        "data":{
            "email":{string},
            "status":{string}
        }
        "url": "http://localhost/user/change-status",
        "method": "POST",
        "headers": {
            "Authorization": "Bearer {your_token}",
            "accept": "application/json"
        }
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
    </code>
</pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "item": {
        "id": 4,
        "first_name": "suspended_f_name",
        "last_name": "suspended_l_name",
        "username": "testsuspended",
        "email": "suspended@test.com",
        "status": "regular",
        "timezone": "",
        "options": "",
        "created_at": null,
        "updated_at": "2019-07-15 17:56:12"
    }
</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Accept: "application/json" <br/>
                Authorize: "Bearer {your-token}"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                email/username: required|email or username| string<br/>
                status: required|string
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/user/change-status</code></p>


        <!-- END CHANGE STATUS -->

        <!-- START DELETE USER -->

        <h2>Delete User</h2>
        <p>
            This request will make it possible for admins to delete their users.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre>
    <code class="language-bash">
        curl -X POST "http://localhost/api/user/delete" \-H "Accept: application/json"
    </code>
</pre>
        <pre>
    <code class="language-javascript">
    var settings = {
        "data":{
            "email":{string}        }
        "url": "http://localhost/user/delete",
        "method": "POST",
        "headers": {
            "Authorization": "Bearer {your_token}",
            "accept": "application/json"
        }
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
    </code>
</pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "User": {
        "id": 4,
        "first_name": "suspended_f_name",
        "last_name": "suspended_l_name",
        "username": "testsuspended",
        "email": "suspended@test.com",
        "status": "regular",
        "timezone": "",
        "options": "",
        "created_at": null,
        "updated_at": "2019-07-15 17:56:12"
    },
    "message": "Testsuspended has been deleted",

}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Accept: "application/json" <br/>
                Authorize: "Bearer {your-token}"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                email/username: required|email or username| string<br/>
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/user/delete</code></p>


        <!-- END DELETE USER -->


        <!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->
        <!-- START_2ea88ff35aa222f5582e50f39a2b35fd -->
        <h2>Get authenticated user</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/user" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/user",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "user": {
        "id": 2,
        "first_name": "user_f_name",
        "last_name": "user_l_name",
        "email": "user@test.com",
        "created_at": null,
        "updated_at": null,
        "roles": [
            {
                "id": 2,
                "name": "advanced-user",
                "display_name": "Advanced User",
                "description": "A middle priority for user",
                "created_at": "2017-06-21 14:13:22",
                "updated_at": "2017-06-21 14:13:22",
                "pivot": {
                    "user_id": 2,
                    "role_id": 2
                },
                "permissions": [
                    {
                        "id": 5,
                        "name": "read-images",
                        "display_name": "Read Images",
                        "description": "User who can read from images table",
                        "created_at": "2017-06-21 14:13:22",
                        "updated_at": "2017-06-21 14:13:22",
                        "pivot": {
                            "role_id": 2,
                            "permission_id": 5
                        }
                    },
                    {
                        "id": 6,
                        "name": "edit-images",
                        "display_name": "Edit images",
                        "description": "User who can edit images",
                        "created_at": "2017-06-21 14:13:22",
                        "updated_at": "2017-06-21 14:13:22",
                        "pivot": {
                            "role_id": 2,
                            "permission_id": 6
                        }
                    },
                    {
                        "id": 7,
                        "name": "create-images",
                        "display_name": "Create images",
                        "description": "User who can upload images",
                        "created_at": "2017-06-21 14:13:22",
                        "updated_at": "2017-06-21 14:13:22",
                        "pivot": {
                            "role_id": 2,
                            "permission_id": 7
                        }
                    },
                    {
                        "id": 8,
                        "name": "delete-images",
                        "display_name": "Delete images",
                        "description": "User who can delete images",
                        "created_at": "2017-06-21 14:13:22",
                        "updated_at": "2017-06-21 14:13:22",
                        "pivot": {
                            "role_id": 2,
                            "permission_id": 8
                        }
                    }
                ]
            }
        ]
    }
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/user</code></p>
        <p><code>HEAD api/user</code></p>
        <!-- END_2ea88ff35aa222f5582e50f39a2b35fd -->
        <!-- START_451ea6811cf31c8fadd3fdcf7ab7fcbd -->
        <h2>Add / Remove role for user</h2>
        <p>
            System will automatically detect role for user.
            If user already has role then role will be removed for user,
            and will be added if role is missing for user.
            This action is permission based action.
            Before any request make sure you have the permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/user/{id}/toggle-role" \
-H "Accept: application/json"</code></pre>
        <pre>
    <code class="language-javascript">
    var settings = {
        "url": "http://localhost/api/user/{id}/toggle-role",
        "data": {
            "role_id": {integer}
        },
        "method": "PUT",
        "headers": {
            "Authorization": "auth_token"
            "accept": "application/json"
        }
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
    </code>
</pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre>
    <code class="language-json">{
    "success": true,
    "user": {
        "id": 12,
        "first_name": "Deion",
        "last_name": "Yundt",
        "email": "jschaefer@example.net",
        "created_at": "2017-06-21 14:13:16",
        "updated_at": "2017-06-21 14:13:16",
        "roles": [
            {
                "id": 2,
                "name": "advanced-user",
                "display_name": "Advanced User",
                "description": "A middle priority for user",
                "created_at": "2017-06-21 14:13:22",
                "updated_at": "2017-06-21 14:13:22",
                "pivot": {
                    "user_id": 12,
                    "role_id": 2
                }
            }
        ]
    },
    "message": "Role advanced-user added to user"
}</code>
</pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from users table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                role_id: required|integer -> comment ( "ID from roles table" )
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p>
            <code>PUT api/user/{id}/toggle-role</code>
        </p>
        <!-- END_451ea6811cf31c8fadd3fdcf7ab7fcbd -->
        <!-- START_451ea6811cf31c8fadd3fdcf7ab7rtop -->
        <h2>Add / Remove permission to / from role</h2>
        <p>
            System will automatically detect permission for role.
            If role already has permission then permission will be removed from role,
            and will be added if permission is missing for role.
            This action is role based action (admin only).
            Before any request make sure you have the correct role.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/user/{id}/toggle-permission" \
-H "Accept: application/json"</code></pre>
        <pre>
    <code class="language-javascript">
    var settings = {
        "url": "http://localhost/api/user/{id}/toggle-permission",
        "data": {
            "permission_id": {integer}
        },
        "method": "PUT",
        "headers": {
            "Authorization": "auth_token"
            "accept": "application/json"
        }
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
    </code>
</pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre>
    <code class="language-json">{
    "success": true,
    "user": {
        "id": 2,
        "first_name": "user_f_name",
        "username": "testuser",
        "last_name": "user_l_name",
        "email": "user@test.com",
        "status": "regular",
        "timezone": "UTC",
        "created_at": null,
        "updated_at": "2017-09-30 09:23:52",
        "options": null,
        "roles": [
            {
                "id": 2,
                "name": "advanced-user",
                "display_name": "Advanced User",
                "description": "A middle priority for user",
                "created_at": "2017-09-21 17:39:00",
                "updated_at": "2017-09-21 17:39:00",
                "pivot": {
                    "user_id": 2,
                    "role_id": 2
                }
            }
        ]
    },
    "message": "Permission delete-images removed from role advanced-user",
}</code>
</pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from roles table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                permission_id: required|integer -> comment ( "ID from permissions table" )
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p>
            <code>PUT api/user/{id}/toggle-permission</code>
        </p>
        <!-- END_451ea6811cf31c8fadd3fdcf7ab7rtop -->
        <!-- START_136660ecd841bcd53d3c53a42f2cc5da -->
        <h2>Create watch list</h2>
        <p>
            Watch list contains the following items
        <ul>
            <li>categories</li>
            <li>tickers</li>
            <li>keywords</li>
        </ul>
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre>
    <code class="language-bash">curl -X POST "http://localhost/api/user/watch-list" \
-H "Accept: application/json"
    </code>
</pre>
        <pre>
    <code class="language-javascript">
    var settings = {
        "url": "http://localhost/api/user/watch-list",
        "method": "POST",
        "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
        }
    };

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
    </code>
</pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/user/watch-list</code></p>
        <!-- END_136660ecd841bcd53d3c53a42f2cc5da -->
        <!-- START_c946d91ecfc75606a2f4608e224f55da -->
        <h2>Get watch list</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/user/watch-list" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/user/watch-list",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 0,
    "success": true,
    "count": 0,
    "items": {
        "tickers": [],
        "categories": [],
        "keywords": []
    }
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/user/watch-list</code></p>
        <p><code>HEAD api/user/watch-list</code></p>
        <!-- END_c946d91ecfc75606a2f4608e224f55da -->
        <!-- START_a9a92f71c665c16aa785a6c01ef74bb3 -->
        <h2>Get watch list by ID</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X DELETE "http://localhost/api/user/watch-list/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/user/watch-list/{id}",
    "method": "DELETE",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from watch list table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>DELETE api/user/watch-list/{id}</code></p>
        <!-- END_a9a92f71c665c16aa785a6c01ef74bb3 -->
        <!-- START_26918bb022bf16c1ac792ca5cd29ae3b -->
        <h2>Get user item</h2>
        <p>
            User item can be
        <ul>
            <li>settings</li>
            <li>dashboards</li>
            <li>modules</li>
            <li>roles</li>
        </ul>
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/user/{item}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/user/{item}",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "settings": [
        {
            "id": 3,
            "user_id": 2,
            "title": "Color Theme",
            "key": "color_theme",
            "value": "1"
        },
        {
            "id": 4,
            "user_id": 2,
            "title": "Audio News Alert",
            "key": "audio_news_alert",
            "value": "0"
        }
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                item: required|string -> comment( "available items -> settings | dashboards | modules | roles" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/user/{item}</code></p>
        <p><code>HEAD api/user/{item}</code></p>
        <!-- END_26918bb022bf16c1ac792ca5cd29ae3b -->
        <!-- START_7ec0e13f01e22fb12992f3b5dda11140 -->
        <h2>Get list of categories based on parent ID</h2>
        <p>
            Here {id} is ID of some category. If category with this ID have sub categories,
            then we will get response of nested sub categories of this category
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/categories/{id}/tree" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/categories/{id}/tree",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "categories": [
        {
            "id": 16,
            "category_id": 14,
            "abbreviation": "consequatur-quibusdam-officia",
            "title": "Dr.",
            "description": "Et rerum aspernatur quis ad saepe tempora at. Ut quo similique quasi vel quod. In aliquid ipsa excepturi enim.",
            "subscription": "Trial",
            "active": 1,
            "created_at": "2017-06-21 14:13:19",
            "updated_at": "2017-06-21 14:13:19"
        },
        {
            "id": 27,
            "category_id": 14,
            "abbreviation": "accusamus-quas",
            "title": "Dr.",
            "description": "Fugit error quisquam ut saepe. Quam quo quo saepe est nisi. Ut dolor vel beatae magni sit. Eligendi perspiciatis voluptate quisquam architecto rem eos.",
            "subscription": "Basic",
            "active": 1,
            "created_at": "2017-06-21 14:13:19",
            "updated_at": "2017-06-21 14:13:19"
        }
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from categories table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/categories/{id}/tree</code></p>
        <p><code>HEAD api/categories/{id}/tree</code></p>
        <!-- END_7ec0e13f01e22fb12992f3b5dda11140 -->
        <!-- START_c37ef7f5bc4ea78e433f6031721801b9 -->
        <h2>Get list of categories and sub categories</h2>
        <p>
            Each category that has sub categories will have children key.
            Children is array which will contain sub categories of current category.
            Sub Categories can have their own categories.
            Thus, we are able to have unlimited nested levels here
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/categories/tree" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/categories/tree",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "categories": [
        {
            "id": 1,
            "category_id": null,
            "abbreviation": "suscipit-consequatur",
            "title": "Prof.",
            "description": "Molestiae deserunt odit voluptas corrupti voluptatem in. Et unde ullam quibusdam fugit et et ut eum. Veniam odit ut dignissimos atque repellat harum.",
            "subscription": "Basic",
            "active": 1,
            "created_at": "2017-06-21 14:13:19",
            "updated_at": "2017-06-21 14:13:19",
            "children": [
                {
                    "id": 4,
                    "category_id": 1,
                    "abbreviation": "ut-tempora",
                    "title": "Dr.",
                    "description": "Nihil quo qui omnis nisi aut ut aspernatur. Similique laborum ea et voluptatem. Dignissimos reiciendis sit similique.",
                    "subscription": "Basic",
                    "active": 1,
                    "created_at": "2017-06-21 14:13:19",
                    "updated_at": "2017-06-21 14:13:19",
                    "children": [
                        {
                            "id": 26,
                            "category_id": 4,
                            "abbreviation": "alias-vero",
                            "title": "Miss",
                            "description": "Reprehenderit molestias nostrum asperiores quia et ut similique nostrum. Quo quod est atque. Ad laboriosam eos totam dolores voluptate. Commodi rerum voluptatem sunt repellat eos.",
                            "subscription": "Trial",
                            "active": 1,
                            "created_at": "2017-06-21 14:13:19",
                            "updated_at": "2017-06-21 14:13:19"
                        },
                        {
                            "id": 42,
                            "category_id": 4,
                            "abbreviation": "omnis-laudantium-ea",
                            "title": "Prof.",
                            "description": "Laudantium perspiciatis aliquid reprehenderit nam perspiciatis sit laboriosam. Quod et ut similique eum et.",
                            "subscription": "Trial",
                            "active": 1,
                            "created_at": "2017-06-21 14:13:20",
                            "updated_at": "2017-06-21 14:13:20"
                        },
                        {
                            "id": 49,
                            "category_id": 4,
                            "abbreviation": "reiciendis-distinctio-voluptas",
                            "title": "Miss",
                            "description": "Sit maxime et labore et. At officiis consequatur debitis velit.\nEt quis et sed totam. Minus est autem at. Accusantium sit explicabo facere qui eaque. Ducimus quaerat vitae id provident.",
                            "subscription": "Trial",
                            "active": 1,
                            "created_at": "2017-06-21 14:13:20",
                            "updated_at": "2017-06-21 14:13:20"
                        }
                    ]
                }
            ]
        }
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/categories/tree</code></p>
        <p><code>HEAD api/categories/tree</code></p>
        <!-- END_c37ef7f5bc4ea78e433f6031721801b9 -->
        <!-- START_af67e8c8abce8e878c13a482203ee9c2 -->
        <h2>Get list of tickers for news</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/news/tickers" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/news/tickers",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "tickers": [
        {
            "ticker": "Dolorem occaecati.",
            "time": "2017-06-21 14:13:24"
        },
        {
            "ticker": "Sit odio sequi sit.",
            "time": "2017-06-21 14:13:24"
        },
        {
            "ticker": "Quia autem voluptas.",
            "time": "2017-06-21 14:13:24"
        },
        {
            "ticker": "Recusandae eos quas.",
            "time": "2017-06-21 14:13:24"
        },
        {
            "ticker": "Velit cum optio.",
            "time": "2017-06-21 14:13:23"
        }
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/news/tickers</code></p>
        <p><code>HEAD api/news/tickers</code></p>
        <!-- END_af67e8c8abce8e878c13a482203ee9c2 -->
        <!-- START_cf84a5ebaab79b75870986f8a7eb2f81 -->
        <h2>Parked / Unparked news state changes</h2>
        <p>
            System will automatically detect state for new.
            If a news is already parked then the news will be set to unparked,
            and will be set to parked if news is unparked.
            This action is permission based action.
            Before any request make sure you have the permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/news/{id}/toggle-parked" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/news/{id}/toggle-parked",
    "method": "PUT",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request GET parameters
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from news table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/news/{id}/toggle-parked</code></p>
        <!-- END_cf84a5ebaab79b75870986f8a7eb2f81 -->
        <!-- START_2304bcde166c7d35655140a778345cff -->
        <h2>Update module position</h2>
        <p>
            Each module has the following coordinates
        <ul>
            <li>x</li>
            <li>y</li>
            <li>width</li>
            <li>height</li>
        </ul>
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/modules/{id}/update-coordinates" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/modules/{id}/update-coordinates",
    "method": "POST",
    "data":{
        "dashboard_id":{integer},
        "pos_x":{integer},
        "pos_y":{integer},
        "width":{integer},
        "height":{integer}
    }
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                dashboard_id: required|integer -> comment ( "ID from dashboards table" ) <br />
                pos_x: integer <br />
                pos_y: integer <br />
                width: integer <br />
                height: integer <br />
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/modules/{id}/update-coordinates</code></p>
        <!-- END_2304bcde166c7d35655140a778345cff -->
        <!-- START_b7f80556b08ecb82d17e244bc0151ce2 -->
        <h2>Set active modules for dashboard</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/dashboards/{id}/change-module-state" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards/{id}/change-module-state",
    "data":{
        module_id:{integer},
        status:{string},
        pox_x:{integer},
        poz_y:{integer},
        width:{integer},
        height:{integer}
    }
    "method": "POST",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                module_id: required|integer -> comment ( "ID from modules table" ) <br />
                poz_x: required|integer <br />
                poz_y: required|integer <br />
                width: integer <br />
                height: integer
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/dashboards/{id}/change-module-state</code></p>
        <!-- END_b7f80556b08ecb82d17e244bc0151ce2 -->
        <!-- START_2970a396628ab6cf2b3cca79c67511c1 -->
        <h2>Get only active dashboards</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/dashboards/active" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards/active",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 31,
    "success": true,
    "count": 25,
    "dashboards": [
                {
            "id": 2,
            "user_id": 2,
            "abbreviation": "nobis-animi-minus",
            "name": "Miss",
            "preset": 1,
            "public": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:18",
            "updated_at": "2017-06-21 14:13:18"
        },
                {
            "id": 8,
            "user_id": 47,
            "abbreviation": "eos-nam",
            "name": "Prof.",
            "preset": 1,
            "public": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:18",
            "updated_at": "2017-06-21 14:13:18"
        },
        ....
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/dashboards/active</code></p>
        <p><code>HEAD api/dashboards/active</code></p>
        <!-- END_2970a396628ab6cf2b3cca79c67511c1 -->
        <!-- START_5ae40203e578b4ae2aa24e654badf91e -->
        <h2>Set active dashboards list</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/dashboards/{id}/update-dashboards-list" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards/{id}/update-dashboards-list",
    "method": "PUT",
    "data": {
        status:{string}
    },
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                status:
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/dashboards/{id}/update-dashboards-list</code></p>
        <!-- END_5ae40203e578b4ae2aa24e654badf91e -->
        <!-- START_01c8b3a78424b4b08759800960c2aa8c -->
        <h2>Update setting for authenticated user</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/settings" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/settings",
    "method": "PUT",
    "data": {
        key:{string},
        value:{any}
    },
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "setting": {
        "id": 3,
        "user_id": 2,
        "title": "Color Theme",
        "key": "color_theme",
        "value": "2"
    },
    "message": "Setting with ID 3 has been updated."
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                key: required|string -> comment("Key of available setting") <br/>
                value: required -> comment("Value for setting") <br/>
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/settings</code></p>
        <!-- END_01c8b3a78424b4b08759800960c2aa8c -->
        <!-- START_6b0dfcf2fd0e1d8b73fd377a544713a2 -->
        <h2>Change theme for auth user</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/settings/change-theme" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/settings/change-theme",
    "method": "POST",
    "data": {
        "theme_abbreviation": {string}
    },
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                theme_abbreviation: required|string -> comment ( "abbreviation from themes table" )
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/settings/change-theme</code></p>
        <!-- END_6b0dfcf2fd0e1d8b73fd377a544713a2 -->
        <!-- START_b7e7bcc8013aeb3e40e7b662d4d06201 -->
        <h2>Get list of all dashboards</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/dashboards" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 17,
    "success": true,
    "count": 5,
    "dashboards": [
        {
            "id": 2,
            "user_id": 2,
            "abbreviation": "nobis-animi-minus",
            "name": "Miss",
            "preset": 1,
            "public": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:18",
            "updated_at": "2017-06-21 14:13:18"
        },
        {
            "id": 3,
            "user_id": 39,
            "abbreviation": "voluptas-quae-delectus",
            "name": "Miss",
            "preset": 1,
            "public": 1,
            "active": 0,
            "created_at": "2017-06-21 14:13:18",
            "updated_at": "2017-06-21 14:13:18"
        },
        {
            "id": 8,
            "user_id": 47,
            "abbreviation": "eos-nam",
            "name": "Prof.",
            "preset": 1,
            "public": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:18",
            "updated_at": "2017-06-21 14:13:18"
        },
        {
            "id": 12,
            "user_id": 20,
            "abbreviation": "tenetur-et-consequuntur",
            "name": "Prof.",
            "preset": 1,
            "public": 1,
            "active": 0,
            "created_at": "2017-06-21 14:13:18",
            "updated_at": "2017-06-21 14:13:18"
        },
        {
            "id": 16,
            "user_id": 42,
            "abbreviation": "dolor-non-magnam",
            "name": "Mr.",
            "preset": 1,
            "public": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:18",
            "updated_at": "2017-06-21 14:13:18"
        }
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/dashboards</code></p>
        <p><code>HEAD api/dashboards</code></p>
        <!-- END_b7e7bcc8013aeb3e40e7b662d4d06201 -->
        <!-- START_65a0aa0f579a1ac8992d6b992fd2f7da -->
        <h2>Create new dashboard</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/dashboards" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards",
    "method": "POST",
    "data":{
        "user_id": {integer?},
        "abbreviation": {string?},
        "name": {string},
        "preset": {boolean?},
        "public": {boolean?},
        "active": {boolean?}
    }
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "dashboard": {
        "id": 16,
        "user_id": 42,
        "abbreviation": "dolor-non-magnam",
        "name": "Test dashboard",
        "preset": 1,
        "public": 1,
        "active": 1,
        "created_at": "2017-06-21 14:13:18",
        "updated_at": "2017-06-21 14:13:18"
    },
    "message": "Dashboard has ben saved successfully"
} </code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                user_id: integer -> comment ( "ID from users table" ) <br/>
                abbreviation: string <br/>
                name: required|string <br/>
                preset: boolean -> comment ( "Available for admin only" ), <br/>
                public: boolean -> comment ( "Available for admin only" ), <br/>
                active: boolean <br/>
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/dashboards</code></p>
        <!-- END_65a0aa0f579a1ac8992d6b992fd2f7da -->
        <!-- START_2526ecc8ea27da3f899e62f14cfb97e6 -->
        <h2>Get single dashboard by ID</h2>
        <p>
            Only administrator is able to get any dashboard. For other user roles
            it is possible to get own dashboards only.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/dashboards/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards/{id}",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response.</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "dashboard": {
        "id": 16,
        "user_id": 42,
        "abbreviation": "dolor-non-magnam",
        "name": "Mr.",
        "preset": 1,
        "public": 1,
        "active": 1,
        "created_at": "2017-06-21 14:13:18",
        "updated_at": "2017-06-21 14:13:18"
    }
} </code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from dashboards table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/dashboards/{id}</code></p>
        <p><code>HEAD api/dashboards/{id}</code></p>
        <!-- END_2526ecc8ea27da3f899e62f14cfb97e6 -->
        <!-- START_2526ecc8ea27da3f899e62f14rfy97h5 -->
        <h2>Get modules with news for single dashboard by dashboard ID</h2>
        <p>
            Returned result is an array with news for each module of specified dashboard.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/dashboards/{id}/news" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards/{id}/news",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response.</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 8,
    "success": true,
    "count": 2,
    "news": [
        {
            "id": 1,
            "title": "Insider Trends: Installed Building Products Insider Extends 90-Day Selling Trend",
            "percentage": "0",
            "description": "<p>On Sep 19, 2017, J Michael Nixon, Director, reported a sale of 13,820 shares in Installed Building Products (IBP) for $829,200.  After the Form 4 filing with the SEC, Nixon indirectly controls 1,609,538 shares of the company, which has a market value of $93.8 million as of the prior-day closing price.</p><p>09:14 PM EDT, 09/21/2017 (MT Newswires) -- On Sep 19, 2017, J Michael Nixon, Director, reported a sale of 13,820 shares in Installed Building Products (IBP) for $829,200.  After the Form 4 filing with the SEC, Nixon indirectly controls 1,609,538 shares of the company, which has a market value of $93.8 million as of the prior-day closing price.</p><p>Over the last 90 days, prior to the date of this filing, there have been 8 transactions reported to the SEC, all of which have been sales and have resulted in the disposition of 44,173 company shares by insiders. Relative to the preceding 90-day window of time, there were 20 transactions from 10 insiders that resulted in the net disposition of 549,545 shares.</p><p>This is a lower level of transactions than the peer group average in the 17-company Construction Supplies & Fixtures peer group over the last 90-day period. Within the peer group activity averaged 26.1 transactions per company, and disposition of 165,135 shares on average.</p><p><a target='_blank' class='sec-story-link' href=' http://www.sec.gov/Archives/edgar/data/1580905/000120919117053665/xslF345X03/doc4.xml'>SEC Story Link</a></p><p>Copyright © 2017 MT Newswires, All Rights reserved. Data provided by UpTick Data Technologies.</p>",
            "meta_keywords": "[\"AFTRH.MN\",\"EXTND.MN\",\"USUS.MN\",\"SALE.MN\"]",
            "top": 0,
            "active": 1,
            "show_in_editor": 0,
            "release_date": null,
            "created_at": "2017-09-22 01:14:19",
            "updated_at": "2017-09-22 01:14:19",
            "transmission_id": "",
            "parked": 0,
            "image_id": null,
            "image_path": null,
            "image_title": null,
            "module_id": 1
        },
        ....
    "message": "",
    "execution_time": 0.091401100158691406,
    "used_memory": "2MB"
} </code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from dashboards table" )
            </code>
        </p>
        <h3>
            Available filters.
        </h3>
        <p>
            <code class="language-json">
                perRequest: default is 20 (limit of results per request) <br/>
                page: default 1 (request pagination parameter) <br/>
                order: default desc (allowed desc|asc)
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/dashboards/{id}/news</code></p>
        <p><code>HEAD api/dashboards/{id}/news</code></p>
        <!-- END_2526ecc8ea27da3f899e62f14rfy97h5 -->
        <!-- START_dee7b559acd69fa57060243ab52ba371 -->
        <h2>Update existing dashboard by ID</h2>
        <p>
            Only administrator can update any dashboard. Other users can update
            only their own dashboards.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/dashboards/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards/{id}",
    "method": "PUT",
    "data":{
        "user_id": {integer?},
        "abbreviation": {string?},
        "name": {string},
        "preset": {boolean?},
        "public": {boolean?},
        "active": {boolean?}
    }
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response.</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "dashboard": {
        "id": 25,
        "user_id": 3,
        "abbreviation": "consequatur-est",
        "name": "Test name",
        "preset": 0,
        "public": 1,
        "active": 0,
        "created_at": "2017-06-21 14:13:18",
        "updated_at": "2017-06-26 14:34:27"
    },
    "message": "Dashboard with ID 25 has been updated."
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from dashboards table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                user_id: integer <br/>
                abbreviation: string <br/>
                name: string <br/>
                preset: boolean -> comment ( "Available for admin only" ), <br/>
                public: boolean -> comment ( "Available for admin only" ), <br/>
                active: boolean <br/>
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/dashboards/{id}</code></p>
        <p><code>PATCH api/dashboards/{id}</code></p>
        <!-- END_dee7b559acd69fa57060243ab52ba371 -->
        <!-- START_5a7b3c9eeb9f97d7523f8d6f0b2fbaa0 -->
        <h2>Delete existing dashboard by ID</h2>
        <p>
            Only administrator can delete any dashboard. Other users can delete
            only their own dashboards.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X DELETE "http://localhost/api/dashboards/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/dashboards/{id}",
    "method": "DELETE",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from dashboards table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>DELETE api/dashboards/{id}</code></p>
        <!-- END_5a7b3c9eeb9f97d7523f8d6f0b2fbaa0 -->
        <!-- START_33c7e80b577570798c60c6aaaa112ac1 -->
        <h2>Get list of all modules</h2>
        <p>
            Response result will be modules list where module owner is auth user
            or module preset and public attributes are true.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/modules" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/modules",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 12,
    "success": true,
    "count": 5,
    "modules": [
        {
            "id": 1,
            "user_id": 8,
            "abbreviation": "atque-eius",
            "name": "Prof.",
            "sort_order": 0,
            "public": 1,
            "preset": 1,
            "watch_list": 0,
            "active": 1,
            "created_at": "2017-06-21 14:13:20",
            "updated_at": "2017-06-21 14:13:20"
        },
        {
            "id": 2,
            "user_id": 47,
            "abbreviation": "earum-labore",
            "name": "Miss",
            "sort_order": 1,
            "public": 1,
            "preset": 1,
            "watch_list": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:20",
            "updated_at": "2017-06-21 14:13:20"
        },
        {
            "id": 8,
            "user_id": 28,
            "abbreviation": "rerum-excepturi",
            "name": "Mrs.",
            "sort_order": 7,
            "public": 1,
            "preset": 1,
            "watch_list": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:20",
            "updated_at": "2017-06-21 14:13:20"
        },
        {
            "id": 11,
            "user_id": 3,
            "abbreviation": "iste-suscipit-voluptatem",
            "name": "Prof.",
            "sort_order": 10,
            "public": 1,
            "preset": 1,
            "watch_list": 0,
            "active": 0,
            "created_at": "2017-06-21 14:13:20",
            "updated_at": "2017-06-21 14:13:20"
        },
        {
            "id": 15,
            "user_id": 6,
            "abbreviation": "natus-facere-distinctio",
            "name": "Mr.",
            "sort_order": 14,
            "public": 1,
            "preset": 1,
            "watch_list": 0,
            "active": 0,
            "created_at": "2017-06-21 14:13:21",
            "updated_at": "2017-06-21 14:13:21"
        }
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/modules</code></p>
        <p><code>HEAD api/modules</code></p>
        <!-- END_33c7e80b577570798c60c6aaaa112ac1 -->
        <!-- START_02a9084a815c8b5386324ae172ab700b -->
        <h2>Create new module</h2>
        <p>

        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/modules" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/modules",
    "method": "POST",
    "data":{
        "user_id": {integer?},
        "abbreviation": {string?},
        "name": {string},
        "watch_list": {boolean?},
        "preset": {boolean?},
        "public": {boolean?},
        "active": {boolean?}
    }
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-javascript">
                user_id: integer, <br />
                abbreviation: string, <br />
                name: required|string, <br />
                watch_list: boolean, <br />
                preset: boolean -> comment ( "Available for admin only" ), <br />
                public: boolean -> comment ( "Available for admin only" ), <br />
                active: boolean
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/modules</code></p>
        <!-- END_02a9084a815c8b5386324ae172ab700b -->
        <!-- START_b81e041714fb7045199cd032fb4fe7e6 -->
        <h2>Get single module by ID</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/modules/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/modules/{id}",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "module": {
        "id": 15,
        "user_id": 6,
        "abbreviation": "natus-facere-distinctio",
        "name": "Mr.",
        "sort_order": 14,
        "public": 1,
        "preset": 1,
        "watch_list": 0,
        "active": 0,
        "created_at": "2017-06-21 14:13:21",
        "updated_at": "2017-06-21 14:13:21"
    }
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from modules table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/modules/{id}</code></p>
        <p><code>HEAD api/modules/{id}</code></p>
        <!-- END_b81e041714fb7045199cd032fb4fe7e6 -->
        <!-- START_a412c980d3eedd7e728e2aed0c7156fa -->
        <h2>Update existing module by ID</h2>
        <p>

        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/modules/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/modules/{id}",
    "method": "PUT",
    "data": {
        "user_id": {integer?},
        "abbreviation": {string?},
        "name": {string},
        "public": {boolean?},
        "preset": {boolean?},
        "watch_list": {boolean?},
        "active": {boolean?},
    },
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from modules table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                user_id: integer, <br />
                abbreviation: string, <br />
                name: required|string, <br />
                watch_list: boolean, <br />
                preset: boolean -> comment ( "Available for admin only" ), <br />
                public: boolean -> comment ( "Available for admin only" ), <br />
                active: boolean
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/modules/{id}</code></p>
        <p><code>PATCH api/modules/{id}</code></p>
        <!-- END_a412c980d3eedd7e728e2aed0c7156fa -->
        <!-- START_e85112b0ac03a240eb2880c88d7b0de3 -->
        <h2>Delete existing module by ID</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X DELETE "http://localhost/api/modules/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/modules/{id}",
    "method": "DELETE",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>DELETE api/modules/{id}</code></p>
        <!-- END_e85112b0ac03a240eb2880c88d7b0de3 -->
        <!-- START_da5727be600e4865c1b632f7745c8e91 -->
        <h2>Get list of all users</h2>
        <p>
            This action allowed only for users with read-user permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/users" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/users",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 50,
    "success": true,
    "count": 25,
    "users": [
        {
            "id": 1,
            "first_name": "admin_f_name",
            "last_name": "admin_l_name",
            "email": "admin@test.com",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 2,
            "first_name": "user_f_name",
            "last_name": "user_l_name",
            "email": "user@test.com",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 3,
            "first_name": "advanced_f_name",
            "last_name": "advanced_l_name",
            "email": "advanced@test.com",
            "created_at": null,
            "updated_at": null
        },
        ....
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/users</code></p>
        <p><code>HEAD api/users</code></p>
        <!-- END_da5727be600e4865c1b632f7745c8e91 -->
        <!-- START_12e37982cc5398c7100e59625ebb5514 -->
        <h2>Create single/multiple user(s)</h2>
        <p>
            This action allowed only for users with create-user permission.
            In example request you should send only one data.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/users" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/users",
    "method": "POST",
    "data": {  // create one user only
        "first_name": {string},
        "last_name": {string},
        "email": {string},
        "password": {string}
    },
    "data": {
        "users":[ // create multiple users with one request
            {
                "first_name": {string},
                "last_name": {string},
                "email": {string},
                "password": {string}
            },
            {
                "first_name": {string},
                "last_name": {string},
                "email": {string},
                "password": {string}
            },
            ....
        ],
    },
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                first_name: required|string <br />
                last_name: required|string <br />
                email: required|email <br />
                password: required|string
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/users</code></p>
        <!-- END_12e37982cc5398c7100e59625ebb5514 -->
        <!-- START_8f99b42746e451f8dc43742e118cb47b -->
        <h2>Get user by id</h2>
        <p>
            This action allowed only for users with read-user permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/users/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/users/{id}",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "user": {
        "id": 12,
        "first_name": "Deion",
        "last_name": "Yundt",
        "email": "jschaefer@example.net",
        "created_at": "2017-06-21 14:13:16",
        "updated_at": "2017-06-21 14:13:16"
    }
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from users table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/users/{id}</code></p>
        <p><code>HEAD api/users/{id}</code></p>
        <!-- END_8f99b42746e451f8dc43742e118cb47b -->
        <!-- START_48a3115be98493a3c866eb0e23347262 -->
        <h2>Update existing user by ID</h2>
        <p>
            This action allowed only for users with edit-user permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/users/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/users/{id}",
    "method": "PUT",
    "data": {
        "first_name": {string},
        "last_name": {string},
        "email": {string},
        "password": {string?},
    }
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from users table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                first_name: required|string <br />
                last_name: required|string <br />
                email: required|email <br />
                password: required|string
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/users/{id}</code></p>
        <p><code>PATCH api/users/{id}</code></p>
        <!-- END_48a3115be98493a3c866eb0e23347262 -->
        <!-- START_d2db7a9fe3abd141d5adbc367a88e969 -->
        <h2>Delete existing user by ID</h2>
        <p>
            This action allowed only for users with delete-user permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X DELETE "http://localhost/api/users/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/users/{id}",
    "method": "DELETE",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from users table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>DELETE api/users/{id}</code></p>
        <!-- END_d2db7a9fe3abd141d5adbc367a88e969 -->
        <!-- START_51e581cc9a1f9ee73cc207ec4e67e8d4 -->
        <h2>Get list of all categories</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/categories" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/categories",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 50,
    "success": true,
    "count": 25,
    "categories": [
        {
            "id": 1,
            "category_id": null,
            "abbreviation": "suscipit-consequatur",
            "title": "Prof.",
            "description": "Molestiae deserunt odit voluptas corrupti voluptatem in. Et unde ullam quibusdam fugit et et ut eum. Veniam odit ut dignissimos atque repellat harum.",
            "subscription": "Basic",
            "active": 1,
            "created_at": "2017-06-21 14:13:19",
            "updated_at": "2017-06-21 14:13:19"
        },
        {
            "id": 2,
            "category_id": null,
            "abbreviation": "eligendi-magni-sint",
            "title": "Dr.",
            "description": "Eligendi quaerat impedit maiores eligendi est quibusdam aliquam illo. Dolor consequuntur aperiam enim sint debitis voluptatibus excepturi.",
            "subscription": "Trial",
            "active": 1,
            "created_at": "2017-06-21 14:13:19",
            "updated_at": "2017-06-21 14:13:19"
        },
        {
            "id": 3,
            "category_id": null,
            "abbreviation": "corporis-quo",
            "title": "Prof.",
            "description": "Et voluptatem ut animi. Rerum minus architecto ut vitae autem nisi. Est earum qui maxime ullam. Aut eos possimus culpa porro.",
            "subscription": "Trial",
            "active": 1,
            "created_at": "2017-06-21 14:13:19",
            "updated_at": "2017-06-21 14:13:19"
        },
        ...
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/categories</code></p>
        <p><code>HEAD api/categories</code></p>
        <!-- END_51e581cc9a1f9ee73cc207ec4e67e8d4 -->
        <!-- START_2335abbed7f782ea7d7dd6df9c738d74 -->
        <h2>Create new category</h2>
        <p>By default limit for request is 25.</p>
        <ul>
            <li>Use perRequest={number} to change limit of items</li>
            <li>Use page={number} to switch between pages</li>
        </ul>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/categories" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/categories",
    "method": "POST",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/categories</code></p>
        <!-- END_2335abbed7f782ea7d7dd6df9c738d74 -->
        <!-- START_c3e1c84c6b0ff14496d71900bd82f60c -->
        <h2>Get single category by ID</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/categories/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/categories/{id}",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "category": {
        "id": 23,
        "category_id": 3,
        "abbreviation": "autem-quis",
        "title": "Dr.",
        "description": "Rem voluptatem voluptatem dolorem dolorem et. Illum ipsum consequatur dicta eos voluptatem. Ut molestiae sint quo quae beatae accusamus rerum.",
        "subscription": "Basic",
        "active": 1,
        "created_at": "2017-06-21 14:13:19",
        "updated_at": "2017-06-21 14:13:19"
    }
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from categories table"
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/categories/{id}</code></p>
        <p><code>HEAD api/categories/{id}</code></p>
        <!-- END_c3e1c84c6b0ff14496d71900bd82f60c -->
        <!-- START_549109b98c9f25ebff47fb4dc23423b6 -->
        <h2>Update existing category by ID</h2>
        <p>
            This action allowed only for users with edit-category permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/categories/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/categories/{id}",
    "method": "PUT",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from users table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/categories/{id}</code></p>
        <p><code>PATCH api/categories/{id}</code></p>
        <!-- END_549109b98c9f25ebff47fb4dc23423b6 -->
        <!-- START_7513823f87b59040507bd5ab26f9ceb5 -->
        <h2>Delete single category by ID</h2>
        <p>
            This action allowed only for users with delete-category permission.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X DELETE "http://localhost/api/categories/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/categories/{id}",
    "method": "DELETE",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from categories table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>DELETE api/categories/{id}</code></p>
        <!-- END_7513823f87b59040507bd5ab26f9ceb5 -->
        <!-- START_5a6599f3ecfca4d9787e34f0f3e9212d -->
        <h2>Get list of all news</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/news" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/news",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "total": 119,
    "success": true,
    "count": 3,
    "news": [
        {
            "id": 1,
            "title": "Prof.",
            "percentage": 75,
            "description": "Tempora soluta excepturi enim nulla sunt error asperiores. Accusamus est commodi omnis qui corporis quod. Adipisci impedit non pariatur rerum maiores.",
            "meta_keywords": "[\"Hic qui nobis dolor.\",\"Quos asperiores.\",\"Et eum et sit.\",\"Sit officia odio.\",\"Error laborum.\",\"Quia ut est.\",\"Sunt magni et qui.\"]",
            "top": 1,
            "active": 1,
            "created_at": "2017-06-21 14:13:23",
            "updated_at": "2017-06-21 14:13:23"
        },
        {
            "id": 2,
            "title": "Prof.",
            "percentage": 69,
            "description": "Provident quia libero sit cumque eos dolorem debitis. Magnam excepturi iusto aliquam sed repudiandae et. Ut in molestias sequi sapiente cumque ullam ea aut.",
            "meta_keywords": "[\"Et fugiat qui.\",\"Nam explicabo illo.\"]",
            "top": 0,
            "active": 1,
            "created_at": "2017-06-21 14:13:23",
            "updated_at": "2017-06-21 14:13:23"
        },
        {
            "id": 3,
            "title": "Ms.",
            "percentage": 70,
            "description": "Nihil rerum officia voluptates praesentium praesentium labore. Consequuntur repudiandae eum blanditiis temporibus dignissimos quo vel. Molestias ut ipsa ex soluta possimus est modi.",
            "meta_keywords": "[\"Ab non perspiciatis.\",\"Praesentium autem.\",\"Excepturi delectus.\",\"Fugit minima non.\"]",
            "top": 0,
            "active": 1,
            "created_at": "2017-06-21 14:13:23",
            "updated_at": "2017-06-21 14:13:23"
        }
    ]
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/news</code></p>
        <p><code>HEAD api/news</code></p>
        <!-- END_5a6599f3ecfca4d9787e34f0f3e9212d -->
        <!-- START_aeceef8aaaac3f0954bf7253ecfdb38a -->
        <h2>Create single/multiple news</h2>
        <p>

        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/news" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/news",
    "method": "POST",
    "data":{ // create single news
        "title":{string},
        "percentage":{float},
        "description":{string} // can be long text
        "meta_keywords":{array}
        "top":{boolean},
        "active":{boolean?},
        "created_at":{timestamp?},
        "updated_at":{timestamp?},
    },
    "data":{ // create multiple news with one request
        "news":[
            {
                "title":{string},
                "percentage":{float},
                "description":{string} // can be long text
                "meta_keywords":{array}
                "top":{boolean},
                "active":{boolean?},
                "created_at":{timestamp?},
                "updated_at":{timestamp?}
            },
            {
                "title":{string},
                "percentage":{float},
                "description":{string} // can be long text
                "meta_keywords":{array}
                "top":{boolean},
                "active":{boolean?},
                "created_at":{timestamp?},
                "updated_at":{timestamp?}
            },
            ...
        ]
    },
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                title: required|string, <br />
                percentage: required|float, <br />
                description: required|string <br />
                meta_keywords: required|array[string,string,...,string] <br />
                top: required|boolean, <br />
                active: boolean, <br />
                created_at: timestamp, <br />
                updated_at: timestamp
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/news</code></p>
        <!-- END_aeceef8aaaac3f0954bf7253ecfdb38a -->
        <!-- START_ae268a25480380e2a0d316c2fd903963 -->
        <h2>Get single new by ID</h2>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X GET "http://localhost/api/news/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/news/{id}",
    "method": "GET",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "new": {
        "id": 36,
        "title": "Dr.",
        "percentage": 82,
        "description": "Dolor aliquam explicabo quia id animi et voluptas. Repudiandae nesciunt cum fuga alias. Ut nemo et ipsam laborum labore repudiandae est.",
        "meta_keywords": "[\"Animi et rerum qui.\",\"Porro ut.\",\"Aut ea dolor velit.\"]",
        "top": 0,
        "active": 1,
        "created_at": "2017-06-21 14:13:23",
        "updated_at": "2017-06-21 14:13:23"
    }
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>GET api/news/{id}</code></p>
        <p><code>HEAD api/news/{id}</code></p>
        <!-- END_ae268a25480380e2a0d316c2fd903963 -->
        <!-- START_9366fbdef8dea9738966cdfd7daba9f7 -->
        <h2>Update existing news by ID</h2>
        <p>
            Send this request for updating existing news.
            {id} parameter is required. This action is allowed for users
            who have permission to update news.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X PUT "http://localhost/api/news/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/news/{id}",
    "method": "PUT",
    "data": {
        "title":{string},
        "percentage":{float},
        "description":{string} // can be long text
        "meta_keywords":{array}
        "top":{boolean},
        "active":{boolean?},
        "created_at":{timestamp?},
        "updated_at":{timestamp?},
    },
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "new": {
        "id": 111,
        "title": "updated title",
        "percentage": 13.46,
        "description": "description for updated new is this now",
        "meta_keywords": "['k1','k2']",
        "top": 0,
        "active": true,
        "created_at": null,
        "updated_at": "2017-06-26 19:25:11"
    },
    "message": "New with ID 111 has been updated."
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                id: required|integer -> comment ( "ID from news table" )
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                title: required|string, <br />
                percentage: required|float, <br />
                description: required|string <br />
                meta_keywords: required|array[string,string,...,string] <br />
                top: required|boolean, <br />
                active: boolean, <br />
                created_at: timestamp, <br />
                updated_at: timestamp
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>PUT api/news/{id}</code></p>
        <p><code>PATCH api/news/{id}</code></p>
        <!-- END_9366fbdef8dea9738966cdfd7daba9f7 -->
        <!-- START_bb2ed2300538ecd019d36ca11b3af3fe -->
        <h2>Delete existing new by ID</h2>
        <p>
            Send this request for deleting existing new.
            {id} parameter is required. This action is available for users
            having admin role.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X DELETE "http://localhost/api/news/{id}" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/news/{id}",
    "method": "DELETE",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true,
    "new": {
        "id": 112,
        "title": "title1",
        "percentage": 13.46,
        "description": "Title 1 description",
        "meta_keywords": "['k1','k2']",
        "top": 0,
        "active": 1,
        "created_at": null,
        "updated_at": null
    },
    "message": "New has been deleted"
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>DELETE api/news/{id}</code></p>
        <!-- END_bb2ed2300538ecd019d36ca11b3af3fe -->
        <!-- START_61739f3220a224b34228600649230ad1 -->
        <h2>Logout authenticated user</h2>
        <p>
            This action will sign out user and remove auth_token.
            The removed auth token will not be available for future use.
        </p>
        <blockquote>
            <p>Example request:</p>
        </blockquote>
        <pre><code class="language-bash">curl -X POST "http://localhost/api/logout" \
-H "Accept: application/json"</code></pre>
        <pre><code class="language-javascript">var settings = {
    "url": "http://localhost/api/logout",
    "method": "POST",
    "headers": {
        "Authorization": "Bearer {your_token}",
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});</code></pre>
        <blockquote>
            <p>Example response:</p>
        </blockquote>
        <pre><code class="language-json">{
    "success": true
}</code></pre>
        <h3>
            Header parameters.
        </h3>
        <p>
            <code class="language-json">
                Authorize: "Bearer {your-token}" <br/>
                Accept: "application/json"
            </code>
        </p>
        <h3>
            Request PATH parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>
            Body parameters.
        </h3>
        <p>
            <code class="language-json">
                No parameters
            </code>
        </p>
        <h3>HTTP Request</h3>
        <p><code>POST api/logout</code></p>
        <!-- END_61739f3220a224b34228600649230ad1 -->
    </div>
    <div class="dark-box">
        <div class="lang-selector">
            <a href="#" data-language-name="javascript">JavaScript</a>
            {{--            <a href="#" data-language-name="bash">bash</a>--}}
        </div>
    </div>
</div>
</body>
</html>