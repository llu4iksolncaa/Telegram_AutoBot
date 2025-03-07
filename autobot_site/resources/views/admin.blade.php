<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Администратор</title>
        
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/admin.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="maincontainer">
            <header id="header" class="header">
                <div class="container d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="/">
                            <img src="img/Autobot.png" alt="logo" width="50" height="50">
                        </a>
                    </div>
                    <!-- <p class="text1">«Автобот»</p> -->
                    <nav class="header-nav">
                        <a href="/user_editing">Редактироваие пользователя      |</a>
                        <a href="/UserReportFilter">Отчёт заявок пользователей      |</a>
                        <a href="/otchetAuto">Отчёт заявок на въезд      |</a>
                        <a href="/">  Выход</a>
                    </nav>
                </div>
            </header>
            <!-- <form action="{{ route('userManage') }}" method="GET">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button type="submit">Управление пользователями</button>
            </form>
            
               <form action="{{ route('RegCars') }}"  method="GET">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button type="submit">Управление  машинами</button>
            </form>
                <button type="submit">Управление машинами</button>
            </form> -->
            
            <form class=formtable>
                <!-- <div class="text2">
                    <p>ПО ФЕН-ШУЮ АДМИН ДОЛЖЕН<br/>СПАТЬ ГОЛОВОЙ<br/>НА СЕРВЕРЕ</p>
                </div> -->

                <input value = "+ *" type="button" id="btnUpdateUsers" class="btn btn-default"/>
                <div class="text3">
                    <p>ЗАЯВКИ НА РЕГИСТРАЦИЮ</p>
                </div>

                <table class="grid1" id="grid2"></table>

                <input value = "+ *" type="button" id="btnUpdateUsers1" class="btn btn-default"/>
                <div class="text4">
                    
                    <p>ЗАЯВКИ НА ВЪЕЗД</p>
                    
                </div>
                
                <table class="grid3" id="grid4"></table>
            </form>

            <!-- <div class="container3">
                <button type="submit" class="gog">УДАЛИТЬ ПОЛЬЗОВАТЕЛЯ</button>
                <button type="submit" class="gog">УДАЛИТЬ ЗАЯВКУ</button>
                <button type="submit" class="gog">ЗАЯВКИ НА ВЪЕЗД</button>
            </div>  
            <div class="container4">
                <button type="submit" class="gog">ИЗМЕНИТЬ/ДОБАВИТЬ</button>
                <button type="submit" class="gog">ИЗМЕНИТЬ/ДОБАВИТЬ</button>
            </div>  -->

        </div>
       
        <div class="footer">
            <footer>
                © AVTOBOTS PRODUCTION 2022
            </footer>
        </div>

        <script type="text/javascript">
            var grids;
            function UpAdd(e) {
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-Token' : "{{ csrf_token() }}"
                        }
                    });
                    if (confirm('Are you sure?')) {
                        var record = {
                            id_user: e.data.record.id_user,
                            name: e.data.record.name,
                            surname: e.data.record.surname,
                            patronymic: e.data.record.patronymic,
                            phone_number: e.data.record.phone_number,
                            address: e.data.record.address,
                            telegram_id: e.data.record.telegram_id,
                            approved: 1
                        };
                        $.ajax({ url: '/users/update', data: record, method: 'POST' })  
                        .done(function () {
                            alert('Nice.');
                            grids.reload();
                        })
                        .fail(function () {
                            alert('Failed to save.');
                        });
                    }
                }
                function Update(e) {
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-Token' : "{{ csrf_token() }}"
                        }
                    });
                    if (confirm('Are you sure?')) {
                        var record = {
                            id_user: e.data.record.id_user,
                            name: e.data.record.name,
                            surname: e.data.record.surname,
                            patronymic: e.data.record.patronymic,
                            phone_number: e.data.record.phone_number,
                            address: e.data.record.address,
                            telegram_id: e.data.record.telegram_id,
                            approved: 2
                        };
                        $.ajax({ url: '/users/update', data: record, method: 'POST' })  
                        .done(function () {
                            alert('Nice.');
                            grids.reload();
                        })
                        .fail(function () {
                            alert('Failed to save.');
                        });
                    }
                }
                
                let timerId = setInterval(() => {

                var xhr = new XMLHttpRequest()
                xhr.open('GET', 'users/getCount', true)
                xhr.send()

                xhr.onreadystatechange = function() {
                    if (xhr.readyState != 4) {
                        return
                }

                var UsersCount = JSON.parse(xhr.responseText)   
                var newUsersCount = UsersCount.count - grids.count(true)
                $('#btnUpdateUsers').val("+ " + newUsersCount)

                if (xhr.status === 200) {
                        console.log('result', xhr.responseText)
                    } else {
                        console.log('err', xhr.responseText)
                    }
                }            
                }, 2000);

                $('#btnUpdateUsers').on('click', function () {
                    grids.reload();
                });

                $(document).ready(function () {
                    grids = $('#grid2').grid({
                        uiLibrary: 'bootstrap',
                        dataSource: '/users/index',
                        columns: [
                            { field: 'id_user', title: 'id', hidden: true},
                            { field: 'name', title: 'Имя', sortable: true, colspan: 3}, 
                            { field: 'surname', title: 'Фамилия', sortable: true},
                            { field: 'patronymic', title: 'Отчетство', sortable: true},
                            { field: 'phone_number', title: 'Номер телеофна', sortable: true},
                            { field: 'address', title: 'Номер участка', sortable: true},
                            { field: 'telegram_id', title: 'ID Телеграма', sortable: true},
                            { field: 'approved', title: 'Статус', sortable: true},
                            { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-plus', tooltip: 'Одобрение', events: { 'click': UpAdd} },
                            { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-minus', tooltip: 'Отклонение', events: { 'click': Update } }
                        ],
                        pager: { limit: 5, sizes: [2, 5, 10, 20] }
                    });
                });
        </script>
        
        <script type="text/javascript">
            var grid;

            function Dob(e) {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-Token' : "{{ csrf_token() }}"
                    }
                    
                });
                if (confirm('Вы уверены?')) {
                    var record = {
                        num_car: e.data.record.num_car,
                        model: e.data.record.model,
                        add_info: e.data.record.add_info,
                        dateTime_order: e.data.record.dateTime_order,
                        comment: e.data.record.comment,
                        id_reg_car: e.data.record.id_reg_car,
                        id_user: e.data.record.id_user,
                        approved: 1

                    };
                    $.ajax({ url: '/reg_cars/update', data: record, method: 'POST' })  
                    .done(function () {
                        alert('Nice.');
                        grid.reload();
                    })
                    .fail(function () {
                        alert('Ошибка сохранения.');
                    });
                }
            }
            function Del(e) {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-Token' : "{{ csrf_token() }}"
                    }
                });
                if (confirm('Вы уверены?')) {
                    var record = {
                        num_car: e.data.record.num_car,
                        model: e.data.record.model,
                        add_info: e.data.record.add_info,
                        dateTime_order: e.data.record.dateTime_order,
                        comment: e.data.record.comment,
                        id_reg_car: e.data.record.id_reg_car,
                        id_user: e.data.record.id_user,
                        approved: 2
                    };
                    $.ajax({ url: '/reg_cars/update', data: record, method: 'POST' })  
                    .done(function () {
                        alert('Nice.');
                        grid.reload();
                    })
                    .fail(function () {
                        alert('Ошибка сохранения.');
                    });
                }
            }

            let timerId1 = setInterval(() => {

            var xhr1 = new XMLHttpRequest()
            xhr1.open('GET', 'reg_cars/getCount', true)
            xhr1.send()

            xhr1.onreadystatechange = function() {
                if (xhr1.readyState != 4) {
                    return
            }

            var UsersCount1 = JSON.parse(xhr1.responseText)   
            var newUsersCount1 = UsersCount1.count - grid.count(true)
            $('#btnUpdateUsers1').val("+" + newUsersCount1)
            if (xhr1.status === 200) {
                    console.log('result', xhr1.responseText)
                } else {
                    console.log('err', xhr1.responseText)
                }
            }            
            }, 2000);

            $('#btnUpdateUsers1').on('click', function () {
                grid.reload();
            });
            
            $(document).ready(function () {
                grid = $('#grid4').grid({
                    dataSource: '/reg_cars/',
                    uiLibrary: 'bootstrap',
                    columns: [
                        { field: 'model', title: 'Марка', sortable: true},
                        { field: 'num_car', title: 'Номер машины', sortable: true,},
                        { field: 'dateTime_order', title: 'Дата', sortable: true,},
                        { field: 'add_info', title: 'Инфо', sortable: true,},
                        { field: 'comment', title: 'Коментарий', sortable: true,},
                        { field: 'id_reg_car', title: 'id машины', hidden: true},
                        { field: 'id_user', title: 'id пользователя', hidden: true},
                        { field: 'approved', title: 'Действия', sortable: true,},
                        { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-plus', tooltip: 'Одобрение', events: { 'click': Dob} },
                        { title: '', field: '', width: 35, type: 'icon', icon: 'glyphicon-minus', tooltip: 'Отклонение', events: { 'click': Del } }
                    ],
                    pager: { limit: 5, sizes: [2, 5, 10, 20] }
                });
            });

        </script>
    </body>
</html>
