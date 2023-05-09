        <div class="side-bar">
            
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            var wait = false
            function updataFileName(input){
        
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {                 
                            $('.newpost_preview img').attr('src', e.target.result)
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                    else {
                        var img = input.value;
                        $('.newpost_preview img').attr('src',img);
                    }
                
            }

            function updataFileName3(input){
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {                 
                            $('.editpost_preview img').attr('src', e.target.result)
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                    else {
                        var img = input.value;
                        $('.editpost_preview img').attr('src',img);
                    }
                
            }

            
            function updataFileName2(input){
                if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {                 
                            $('.profilecfg_preview img').attr('src', e.target.result)
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                    else {
                        var img = input.value;
                        $('.profilecfg_preview img').attr('src',img);
                    }
            }

            function togleview(type, edit_element){
                if(window.innerWidth <= 768){
                    if(type == 1){
                        $('.alternative-view-mobile').css('display','none');
                        $('.main-view-mobile').css('display','flex');
                        $('.search-main-mobile').css('left','-500%');
                        $('.newpost-main-mobile').css('left','-500%');
                        $('.profilecfg-main-mobile').css('left','-500%');
                        $('.editpost-main-mobile').css('left','-500%');
                        // $('.side-bar').css('width','15vw');
                        // $('.side-bar .menus').css('text-align','left');
                        // $('.side-bar .menus').css('padding','8% 2% 8% 4%');
                        setTimeout(() => {
                            $('.search-main-mobile').css('display','none');
                            $('.newpost-main-mobile').css('display','none');
                            $('.profilecfg-main-mobile').css('display','none');
                            $('.editpost-main-mobile').css('display','none');
                            
                        }, 200);
                    }else if(type == 2){
                        $('.main-view-mobile').css('display','none');
                        $('.alternative-view-mobile').css('display','flex');
                        $('.newpost-main-mobile').css('left','-500%');
                        $('.profilecfg-main-mobile').css('left','-500%');
                        $('.editpost-main-mobile').css('left','-500%');
                        // $('.side-bar').css('width','6vw');
                        // $('.side-bar .menus').css('text-align','center');
                        // $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.search-main-mobile').fadeIn();
                            $('.search-main-mobile').css('left','0%');
                            $('.newpost-main-mobile').css('display','none');
                            $('.profilecfg-main-mobile').css('display','none');
                            $('.editpost-main-mobile').css('display','none');
                            // $('.alternative-view').fadeIn();
                        }, 400);
                    
                    }else if(type == 3){
                        $('.main-view-mobile').css('display','none');
                        $('.alternative-view-mobile').css('display','flex');
                        $('.search-main-mobile').css('left','-500%');
                        $('.profilecfg-main-mobile').css('left','-500%');
                        $('.editpost-main-mobile').css('left','-500%');
                        // $('.side-bar').css('width','6vw');
                        // $('.side-bar .menus').css('text-align','center');
                        // $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.newpost-main-mobile').fadeIn();
                            $('.newpost-main-mobile').css('left','0%');
                            $('.search-main-mobile').css('display','none');
                            $('.profilecfg-main-mobile').css('display','none');
                            $('.editpost-main-mobile').css('display','none');
                            // $('.alternative-view').fadeIn();
                        }, 400);
                    
                    }else if(type == 4){
                        $('.main-view-mobile').css('display','none');
                        $('.alternative-view-mobile').css('display','flex');
                        $('.search-main-mobile').css('left','-500%');
                        $('.newpost-main-mobile').css('left','-500%');
                        $('.editpost-main-mobile').css('left','-500%');
                        // $('.side-bar').css('width','6vw');
                        // $('.side-bar .menus').css('text-align','center');
                        // $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.profilecfg-main-mobile').fadeIn();
                            $('.profilecfg-main-mobile').css('left','0%');
                            $('.newpost-main-mobile').css('display','none');
                            $('.search-main-mobile').css('display','none');
                            $('.editpost-main-mobile').css('display','none');
                            // $('.alternative-view').fadeIn();
                        }, 400);
                    
                    }else if(type == 5){
                    
                        $('.main-view-mobile').css('display','none');
                        $('.alternative-view-mobile').css('display','flex');
                        $('.search-main-mobile').css('left','-500%');
                        $('.newpost-main-mobile').css('left','-500%');
                        $('.profilecfg-main-mobile').css('left','-500%');
                        // $('.side-bar').css('width','6vw');
                        // $('.side-bar .menus').css('text-align','center');
                        // $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.editpost-main-mobile').fadeIn();
                            $('.editpost-main-mobile').css('left','0%');
                            $('.newpost-main-mobile').css('display','none');
                            $('.search-main-mobile').css('display','none');
                            $('.profilecfg-main-mobile').css('display','none');
                            
                            // $('.alternative-view').fadeIn();
                            
                        }, 400);
                        var inputs = document.getElementsByClassName('editpost_idset')
                        for(var i = 0; i < inputs.length; i ++){
                            inputs[i].value = edit_element.dataset.post_id
                        }
                    }

                }
                else {
                    if(type == 1){
                        $('.alternative-view').css('display','none');
                        $('.search-main').css('left','-500%');
                        $('.newpost-main').css('left','-500%');
                        $('.profilecfg-main').css('left','-500%');
                        $('.editpost-main').css('left','-500%');
                        $('.side-bar').css('width','15vw');
                        $('.side-bar .menus').css('text-align','left');
                        $('.side-bar .menus').css('padding','8% 2% 8% 4%');
                        setTimeout(() => {
                            $('.search-main').css('display','none');
                            $('.newpost-main').css('display','none');
                            $('.profilecfg-main').css('display','none');
                            $('.editpost-main').css('display','none');
                            $('.main-view').fadeIn();
                        }, 200);
                    }else if(type == 2){
                        $('.main-view').css('display','none');
                        $('.newpost-main').css('left','-500%');
                        $('.profilecfg-main').css('left','-500%');
                        $('.editpost-main').css('left','-500%');
                        $('.side-bar').css('width','6vw');
                        $('.side-bar .menus').css('text-align','center');
                        $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.search-main').fadeIn();
                            $('.search-main').css('left','100%');
                            $('.newpost-main').css('display','none');
                            $('.profilecfg-main').css('display','none');
                            $('.editpost-main').css('display','none');
                            // $('.alternative-view').css('display','flex');
                            $('.alternative-view').fadeIn();
                        }, 400);
                    
                    }else if(type == 3){
                        $('.main-view').css('display','none');
                        $('.search-main').css('left','-500%');
                        $('.profilecfg-main').css('left','-500%');
                        $('.editpost-main').css('left','-500%');
                        $('.side-bar').css('width','6vw');
                        $('.side-bar .menus').css('text-align','center');
                        $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.newpost-main').fadeIn();
                            $('.newpost-main').css('left','100%');
                            $('.search-main').css('display','none');
                            $('.profilecfg-main').css('display','none');
                            $('.editpost-main').css('display','none');
                            $('.alternative-view').fadeIn();
                        }, 400);
                    
                    }else if(type == 4){
                        $('.main-view').css('display','none');
                        $('.search-main').css('left','-500%');
                        $('.newpost-main').css('left','-500%');
                        $('.editpost-main').css('left','-500%');
                        $('.side-bar').css('width','6vw');
                        $('.side-bar .menus').css('text-align','center');
                        $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.profilecfg-main').fadeIn();
                            $('.profilecfg-main').css('left','100%');
                            $('.newpost-main').css('display','none');
                            $('.search-main').css('display','none');
                            $('.editpost-main').css('display','none');
                             $('.alternative-view').fadeIn();
                        }, 400);
                    
                    }else if(type == 5){
                    
                        $('.main-view').css('display','none');
                        $('.search-main').css('left','-500%');
                        $('.newpost-main').css('left','-500%');
                        $('.profilecfg-main').css('left','-500%');
                        $('.side-bar').css('width','6vw');
                        $('.side-bar .menus').css('text-align','center');
                        $('.side-bar .menus').css('padding','20% 2% 20% 4%');
                        setTimeout(() => {
                            $('.editpost-main').fadeIn();
                            $('.editpost-main').css('left','100%');
                            $('.newpost-main').css('display','none');
                            $('.search-main').css('display','none');
                            $('.profilecfg-main').css('display','none');

                            $('.alternative-view').fadeIn();
                            
                        }, 400);
                        var inputs = document.getElementsByClassName('editpost_idset')
                        for(var i = 0; i < inputs.length; i ++){
                            inputs[i].value = edit_element.dataset.post_id
                        }
                    }
                }
            }

            function searchUser(input){
                let search = input.value;
                let grid = "<h2>Resultados</h2>"
                if (search ){
                    wait = wait + 1
                    let value = wait
                    setTimeout(() => {
                        if(wait == value){
                            $.ajax({
                                url : "<?php echo API_URL ?>",
                                type : 'POST',
                                data : {
                                    'search' : search
                                },
                                success : function(results) { 

                                    grid+= results     
                                    $('.result-side').html(grid)
                                },
                                error : function(request,error)
                                {
                                    $.ajax({
                                        url : "<?php echo API_URL2 ?>",
                                        type : 'POST',
                                        data : {
                                            'search' : search
                                        },
                                        success : function(results) { 

                                            grid+= results     
                                            $('.result-side').html(grid)
                                        },
                                        error : function(request,error)
                                        {
                                        }
                                    });
                                }
                            });
                        }
                    }, 2000);
                }
                $('.result-side').html(grid)
                
            }

            

            var desktopSidebar = `
            <div class="search-main">
                <div class="input-side">
                    <h2>Pesquisa</h2>
                    <input type="text" oninput="searchUser(this)" placeholder="Pesquisar...">
                </div>
                <div class="result-side">
                    <h2>Resultados</h2>
                </div>
            </div>
            <div class="newpost-main">
                <h1>Novo post</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="drop">
                        <h3 id="file_name">Selecionar arquivo</h3>
                        <input oninput="updataFileName(this)" type="file" accept="video/*,image/*" name="newpost_image">
                    </div>
                    <div class="newpost_preview">
                        <img>
                    </div>
                    <textarea maxlength="250" name="newpost_descripition" cols="30" rows="5" placeholder="Descrição..."></textarea>
                    <input type="submit" name="newpost_public">
                </form>
            </div>
            <div class="editpost-main">
                <h1>Editar post</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="drop">
                        <h3 id="file_name">Selecionar arquivo</h3>
                        <input oninput="updataFileName3(this)" type="file" accept="video/*,image/*" name="editpost_image">
                    </div>
                    <div class="editpost_preview">
                        <img>
                    </div>
                    <textarea maxlength="250" name="editpost_descripition" cols="30" rows="5" placeholder="Descrição..."></textarea>
                    <input type="submit" name="editpost_public" value="Salvar">
                    <input type="hidden" class="editpost_idset" name="editpost_id" value="none">
                </form>
                <form action=""  method="post">
                    <input type="submit" name="editpost_delete" value="Deletar">
                    <input type="hidden" class="editpost_idset" name="editpost_id" value="none">
                </form>
            </div>
            <div class="profilecfg-main">
                <h1>Meu Perfil</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="drop">
                        <h3 id="file_name">Atualizar foto de perfil</h3>
                        <input value="" oninput="updataFileName2(this)" type="file" accept="video/*,image/*" name="profilecfg_image">
                    </div>
                    <div class="profilecfg_preview">
                        <img>
                    </div>
                    <textarea value="" maxlength="250" name="updateprofile_bio" cols="30" rows="5" placeholder="Biografia..."></textarea>
                    <input type="submit" name="updateprofile" value="Salvar">
                </form>
            </div>
            <div class="main-view">
                <a class="homeBack menus" href="<?php echo INCLUDE_PATH?>">SNetwork</a>
                    <a class="menus" href="<?php echo INCLUDE_PATH?>home"><i class="fa-solid fa-house"></i> Página Inicial</a>
                    <button onclick="togleview(2)" class="menus"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                    <button onclick="togleview(3)" class="menus"><i class="fa-solid fa-plus"></i> Criar</button>
                    <button onclick="togleview(4)" class="menus"><i class="fa-solid fa-user"></i> Editar Perfil</button>
                    <form class="menus" action="" method="post">
                        <input type="submit" name="disconect" value="">
                        <p><i class="fa-solid fa-right-from-bracket"></i>  Sair</p>
                    </form>     
            </div>
            <div class="alternative-view">
                <a class="homeBack" href="<?php echo INCLUDE_PATH?>">SN</a>
                <button class="menus" onclick="togleview(1)"><i class="fa-solid fa-xmark"></i></button>
                <button class="menus"  onclick="togleview(2)" ><i class="fa-solid fa-magnifying-glass"></i></button>
                <button class="menus" onclick="togleview(3)" ><i class="fa-solid fa-plus"></i></button>
                <button class="menus"  onclick="togleview(4)" ><i class="fa-solid fa-user"></i></button>
                <form class="menus" action="" method="post">
                    <input type="submit" name="disconect" value="">
                    <p><i class="fa-solid fa-right-from-bracket"></i></p>
                </form>
            </div>
            `

            var mobileSidebar = `
            <div class="search-main-mobile">
                <div class="input-side">
                    <h2>Pesquisa</h2>
                    <input type="text" oninput="searchUser(this)" placeholder="Pesquisar...">
                </div>
                <div class="result-side">
                    <h2>Resultados</h2>
                </div>
            </div>
            <div class="newpost-main-mobile">
                <h1>Novo post</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="drop">
                        <h3 id="file_name">Selecionar arquivo</h3>
                        <input oninput="updataFileName(this)" type="file" accept="video/*,image/*" name="newpost_image">
                    </div>
                    <div class="newpost_preview">
                        <img>
                    </div>
                    <textarea maxlength="250" name="newpost_descripition" cols="30" rows="5" placeholder="Descrição..."></textarea>
                    <input type="submit" name="newpost_public">
                </form>
            </div>
            <div class="editpost-main-mobile">
                <h1>Editar post</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="drop">
                        <h3 id="file_name">Selecionar arquivo</h3>
                        <input oninput="updataFileName3(this)" type="file" accept="video/*,image/*" name="editpost_image">
                    </div>
                    <div class="editpost_preview">
                        <img>
                    </div>
                    <textarea maxlength="250" name="editpost_descripition" cols="30" rows="5" placeholder="Descrição..."></textarea>
                    <input type="submit" name="editpost_public" value="Salvar">
                    <input type="hidden" class="editpost_idset" name="editpost_id" value="none">
                </form>
                <form action=""  method="post">
                    <input type="submit" name="editpost_delete" value="Deletar">
                    <input type="hidden" class="editpost_idset" name="editpost_id" value="none">
                </form>
            </div>
            <div class="profilecfg-main-mobile">
                <h1>Meu Perfil</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="drop">
                        <h3 id="file_name">Atualizar foto de perfil</h3>
                        <input value="" oninput="updataFileName2(this)" type="file" accept="video/*,image/*" name="profilecfg_image">
                    </div>
                    <div class="profilecfg_preview">
                        <img>
                    </div>
                    <textarea value="" maxlength="250" name="updateprofile_bio" cols="30" rows="5" placeholder="Biografia..."></textarea>
                    <input type="submit" name="updateprofile" value="Salvar">
                </form>
            </div>
            <div class="main-view-mobile">
            <a class="menus" href="<?php echo INCLUDE_PATH?>home"><i class="fa-solid fa-house"></i></a>
                <button class="menus"  onclick="togleview(2)" ><i class="fa-solid fa-magnifying-glass"></i></button>
                <button class="menus" onclick="togleview(3)" ><i class="fa-solid fa-plus"></i></button>
                <button class="menus"  onclick="togleview(4)" ><i class="fa-solid fa-user"></i></button>
                <form class="menus" action="" method="post">
                    <input type="submit" name="disconect" value="">
                    <p><i class="fa-solid fa-right-from-bracket"></i></p>
                </form>
            </div>
            <div class="alternative-view-mobile">
                <a class="homeBack" href="<?php echo INCLUDE_PATH?>">SN</a>
                <button class="menus" onclick="togleview(1)"><i class="fa-solid fa-xmark"></i></button>
                <button class="menus"  onclick="togleview(2)" ><i class="fa-solid fa-magnifying-glass"></i></button>
                <button class="menus" onclick="togleview(3)" ><i class="fa-solid fa-plus"></i></button>
                <button class="menus"  onclick="togleview(4)" ><i class="fa-solid fa-user"></i></button>
                <form class="menus" action="" method="post">
                    <input type="submit" name="disconect" value="">
                    <p><i class="fa-solid fa-right-from-bracket"></i></p>
                </form>
            </div>
            `
            function resize(){
                if(window.innerWidth <= 768){
                    $('.side-bar').html(mobileSidebar)
                }else {
                    $('.side-bar').html(desktopSidebar)
                }
                    
            }

            window.addEventListener('resize', () => {
                if(window.innerWidth <= 768){
                    $('.side-bar').html(mobileSidebar)
                }else {
                    $('.side-bar').html(desktopSidebar)
                }
            });
            resize()
        </script>

