
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Negocios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item text-sm"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>
            <li class="breadcrumb-item text-sm active">Negocios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header"></div>
      <div class="card-body">        
        <table class="table table-bordered table-striped dt-responsive-listanegocios tablaNegocios">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Negocio</th>
              <th>Rubro</th>
              <th>Estado</th>
              <th>Ver Información</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;

            $perfiles = ControladorNegocio::ctrMostrarNegociosWeb($item, $valor);
            
             foreach ($perfiles as $key => $value){
                 echo ' <tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["razon_social"].'</td>
                          <td>'.strtoupper($value["rubro"]).'</td>';

                          if($value["estado"] != 0){
                            echo '<td><button class="btn btn-success btn-xs">Vigente</button></td>';
                          }else{
                            echo '<td><button class="btn btn-danger btn-xs">No Vigente</button></td>';
                          } 

                          if($value["estado"] != 0){
                            echo '<td>
                                  <div class="btn-group">                              
                                    <button class="btn btn-warning btnVerNegocio" idNegocioWeb = "'.$value["idnegocio"].'" data-toggle="modal" data-target="#modalVerNegocio"><i class="fa fa-eye"></i></button>
                                    <button class="btn btn-success btnVerCodigo" idNegWeb = "'.$value["idnegocio"].'" data-toggle="modal" data-target="#modalVerCodigo"><i class="fa fa-lock"></i></button>
                                  </div>  
                                </td>
                              </tr>';
                          }else{
                            echo '<td>
                                  <div class="btn-group">                              
                                    <button class="btn btn-warning btnVerNegocio" idNegocioWeb = "'.$value["idnegocio"].'" data-toggle="modal" data-target="#modalVerNegocio" disabled><i class="fa fa-eye"></i></button>
                                  </div>  
                                </td>
                              </tr>';
                          } 
                                     
             }
            ?>
          </tbody>
        </table>
      </div>

      <!-- <div class="card-footer">
        Footer
      </div> -->
    </div>
  </section>
</div>

<!--=====================================
MODAL VER TEMA
======================================-->
<div id="modalVerNegocio" class="modal fade modalVerNegocio">
  <div class="modal-dialog modal-xl">  <!-- modal-lg -->
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <!--<div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title" ></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white;">&times;</span>
          </button>
        </div>-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div id="tittle" class="modal-body">          
          <div class="card-body">
            <!--=====================================
            ENTRADA PARA LA SECCION
            ======================================-->
            <div class="form-group">
              <div class="seccion"></div>
              <input type="hidden" class="idNegocioWeb"> 
              </select>			  
            </div>

            <!--=====================================
            ENTRADA PARA EL CONTENIDO
            ======================================-->
            <div class="form-group">
              <div class="contenido"></div>			  
            </div>

            <!--=====================================
            ENTRADA PARA EL WHATSAPP
            ======================================-->
            <!--<div class="popup-botton-whatsapp-p" >
              <div class="container-exterior-p" style="right: 60px;">
                <div class="msg-inicial-d active-popup-whatsapp-msg-p" id="msg-inicial-w">
                  <span>¿Necesitas ayuda? <strong>habla con nosotros</strong></span>
                </div>
                <div class="button-whatsapp-p" id="button-whatsapp" >
                  <i class="fa fa-whatsapp fa-2-2x" id="fa-whatsapp"  aria-hidden="true"></i>
                </div>
              </div>
              <div class="container-interior-p" id="container-interior-w" >
                <div class="popup-header-chat-p">
                  
                  <div class="popup-icon-p">
                    <i class="fa fa-whatsapp fa-2-2x" aria-hidden="true"></i>
                  </div>
                  <div class="popup-title-p">
                    <span style="font-size: 18px;">Iniciar Conversación</span>
                    <br>
                    <span style="font-size: 14px;">
                      ¡Hola! Haga clic en uno de nuestros miembros a continuación para chatear en <strong>WhatsApp</strong>
                    </span>
                  </div>
                </div>
                <div class="popup-body-chat-p">
                  <div class="popup-msg-intro-p">
                    El equipo suele responder en unos minutos.
                  </div>
                  <div class="popup_content_list">
                    <div class="popup_content_item-d">
                      <a target="_blank" href="https://api.whatsapp.com/send?phone=+51953596885&text=Buen%20d%C3%ADa,%20me%20interesa%20conocer%20mas%20acerca%20de%20los%20servicios" class="popup-link-p">
                        <div class="popup-icon-p watssapp-p">
                          <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </div>
                        <div class="popup_txt">
                          <div class="nombre-asesor-p">Pablo Morales</div>
                          <div class="cargo-asesor-p">Asistente Virtual</div>
                        </div>
                        <div class="popup-icon-p">
                          <i class="fa fa-whatsapp fa-2-2x" aria-hidden="true"></i>
                        </div>
                      </a>
                    </div>
                  </div>		   
                </div>	   
              </div>
            </div>-->

            <!--=====================================
            ENTRADA PARA EL BOTON SUBIDA
            ======================================-->
            <div class="form-group">
              <div class="btnSubir"></div>			  
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>
    </div>
  </div>
</div>

<!--=====================================
MODAL GENERAR CÓDIGO USUARIO-NEGOCIO
======================================-->
<div id="modalVerCodigo" class="modal fade modalVerCodigo">
  <div class="modal-dialog modal-xl">  <!-- modal-lg -->
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background-color: #3c8dbc; color:white">
          <h4 class="modal-title">Código Generado</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white;">&times;</span>
          </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div id="tittle" class="modal-body">          
          <div class="card-body">
            <!--=====================================
            ENTRADA PARA LA SECCION
            ======================================-->
            <div class="form-group">
              <div class="codigo"></div>
              <input type="hidden" class="idCodigoGenerado"> 
              </select>			  
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer justify-content-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>
    </div>
  </div>
</div>