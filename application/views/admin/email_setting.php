<div class="card">
  <div class="row"> 
    <!-- panel  -->
    <div class="col-md-12">
      <div class="panel panel-border panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Configuración de correo electrónico</h3>
        </div>
        <div class="panel-body">
          <?php echo form_open(base_url() . 'admin/email_setting/update/' , array('class' => 'form-horizontal group-border-dashed', 'enctype' => 'multipart/form-data','id'=>'mail'));?> 
          <!-- panel  -->     
          <h4>Email de contacto</h4>
          <hr>
          <div class="form-group row">
            <label class="col-sm-3 control-label">Email de contacto</label>
            <div class="col-sm-9">
              <input type="email"  value="<?php echo $this->db->get_where('config' , array('title' =>'contact_email'))->row()->value;?>" name="contact_email" class="form-control"   />
              <p>Todo el correo de contacto enviará a este correo electrónico.</p>
            </div>
          </div>
          <h4>Configuración del servidor saliente</h4>
          <hr>          
          <div class="form-group row">
            <label class="control-label col-md-3">Tipo de correo</label>
            <div class="col-sm-3">
                <select class="form-control m-bot15" id="protocol" name="protocol">
                  <option value="mail" <?php if($this->db->get_where('config' , array('title' =>'protocol'))->row()->value=='mail'){echo 'selected';}?> >Correo</option>                  
                  <option value="smtp" <?php if($this->db->get_where('config' , array('title' =>'protocol'))->row()->value=='smtp'){echo 'selected';}?> >SMTP (recomendado)</option>
                  <option value="sendmail" <?php if($this->db->get_where('config' , array('title' =>'protocol'))->row()->value=='sendmail'){echo 'selected';}?> >sednmail</option>
                </select>
            </div>
          </div>

          <div id="smtp">
            <div class="form-group row">
              <label class="col-sm-3 control-label">Dirección del servidor SMTP</label>
              <div class="col-sm-9">
                <input type="text"  value="<?php echo $this->db->get_where('config' , array('title' =>'smtp_host'))->row()->value;?>" name="smtp_host" class="form-control"   placeholder="ex: smtp.gmail.com"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Nombre de usuario SMTP</label>
              <div class="col-sm-9">
                <input type="text"  value="<?php echo $this->db->get_where('config' , array('title' =>'smtp_user'))->row()->value;?>" name="smtp_user" class="form-control"   placeholder="ex: example@gmail.com"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Contraseña SMTP</label>
              <div class="col-sm-9">
                <input type="password"  value="*************" name="smtp_pass" class="form-control"   placeholder="ex: ******"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label">Puerto SMTP</label>
              <div class="col-sm-9">
                <input type="text"  value="<?php echo $this->db->get_where('config' , array('title' =>'smtp_port'))->row()->value;?>" name="smtp_port" class="form-control"   placeholder="ex: 465"/>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3">Crypto SMTP</label>
              <div class="col-sm-3">
                  <select class="form-control m-bot15" id="slider_type" name="smtp_crypto">
                    <option value="ssl" <?php if($this->db->get_where('config' , array('title' =>'smtp_crypto'))->row()->value=='ssl'){echo 'selected';}?> >Ssl</option>
                    <option value="tls" <?php if($this->db->get_where('config' , array('title' =>'smtp_crypto'))->row()->value=='tls'){echo 'selected';}?> >Tls</option>
                  </select>
              </div>
            </div>
          </div>
          <div id="sendmail">
            <div class="form-group row">
              <label class="col-sm-3 control-label">Ruta de correo</label>
              <div class="col-sm-9">
                <input type="text"  value="<?php echo $this->db->get_where('config' , array('title' =>'mailpath'))->row()->value;?>" name="mailpath" class="form-control"   placeholder="ex: /usr/bin/sendmail"/>
              </div>
            </div>
          </div>


          <div class="col-sm-offset-3 col-sm-9 m-t-15">
            <button type="submit" class="btn btn-sm btn-primary"><span class="btn-label"><i class="fa fa-floppy-o"></i></span>Guardar Cambios </button>
          </div>
          <?php echo form_close(); ?> 
        </div>
      </div>
    
<?php echo form_open(base_url() . 'admin/test_mail' , array('class' => 'form-horizontal group-border-dashed', 'enctype' => 'multipart/form-data','id'=>'test-mail'));?>
      <div class="col-md-6 offset-md-3">
        <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Configuración de prueba</h3>
          </div>
          <div class="panel-body">
            <div class="form-group row m-b-0">
                                
                  <div class="input-group">
                    <input type="email" class="form-control" name='email' value="<?php echo $this->db->get_where('config' , array('title' =>'contact_email'))->row()->value;?>" placeholder="Introduce tu correo electrónico" required>
                    <span class="input-group-btn">
                    <button type="submit" id="import_btn" class="btn btn-primary w-sm waves-effect waves-light"> Prueba </button>
                    
                    </span> </div>
                    <div id="result"></div>
                <?php echo form_close(); ?>        
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        <?php $protocol=$this->db->get_where('config' , array('title' =>'protocol'))->row()->value;
        if ($protocol=='smtp'):?>
        $("#sendmail").fadeOut();
        <?php endif; if ($protocol=='sendmail'):?>
        $("#smtp").fadeOut();
        <?php endif;?>
        <?php if($protocol=='mail'):?>
        $("#sendmail").fadeOut();
        $("#smtp").fadeOut();
      <?php endif; ?>
        
    });
    $("#protocol").change(function() {
        var protocol = $("#protocol option:selected").val();
        if (protocol == 'smtp') {
            $("#smtp").fadeIn();
            $("#sendmail").fadeOut();
        } else if (protocol == 'sendmail') {
            $("#smtp").fadeOut();
            $("#sendmail").fadeIn();
        }
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script> 
<script type="text/javascript">
      $(document).ready(function() {
        $('#mail').parsley();
        $('#test-mail').parsley();
      });
    </script> 

<!-- file select--> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script> 
<!-- file select--> 

