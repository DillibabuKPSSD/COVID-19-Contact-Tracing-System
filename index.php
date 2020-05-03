<?php 
  //---------------------------------------------------------------------------------------------------------------------
  //Purpose   : COVID-19 Contact Tracing System:-------------------------------------------------------------------------
  //Developers : 
  //      K.Dilli (mailtodillibabu@gmail.com)
  //      K.Suresh (mailtosureshk87@gmail.com)
  //      K.Sankar (mailtosankark@gmail.com)
  //---------------------------------------------------------------------------------------------------------------------

  require("config.php");

	/*echo "<pre>"; print_r($_SESSION);die("");*/
	$_SESSION['distance'] = $_POST['distance'] ?? ($_SESSION['distance'] ?? 0.01);
	$_SESSION['device_id'] = $_POST['device_id'] ?? ($_SESSION['device_id'] ?? 0);
	$_SESSION['start_datetime'] = $_POST['start_datetime'] ?? ($_SESSION['start_datetime'] ?? "2020-04-10 16:35:47"); //date("Y-m-d H:i:s"))
	$_SESSION['end_datetime'] = $_POST['end_datetime'] ?? ($_SESSION['end_datetime'] ?? date("Y-m-d H:i:s"));
	$_SESSION['limit'] = $_POST['limit'] ?? ($_SESSION['limit'] ?? 300);

	$devices = [];
	$sql = "SELECT * FROM tc_devices";
	$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#333">
    <title>COVID-19</title>
    <meta name="description" content="COVID-19">
    <link rel="shortcut icon" href="http://techiebros.in/techiebros/2.0/assets/img/favicon30f4.png?v=3">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="http://techiebros.in/techiebros/2.0/assets/css/preload.min.css">
    <link rel="stylesheet" href="http://techiebros.in/techiebros/2.0/assets/css/plugins.min.css">
    <link rel="stylesheet" href="http://techiebros.in/techiebros/2.0/assets/css/style.light-blue-500.min.css">
    <link rel="stylesheet" href="http://techiebros.in/techiebros/2.0/assets/css/width-boxed.min.css" id="ms-boxed" disabled="">
    <!--[if lt IE 9]>
        <script src="http://techiebros.in/techiebros/2.0/assets/js/html5shiv.min.js"></script>
        <script src="http://techiebros.in/techiebros/2.0/assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <a href="javascript:void(0)" class="ms-conf-btn ms-configurator-btn btn-circle btn-circle-raised btn-circle-primary animated rubberBand"><i class="fa fa-gears"></i></a>
    <div id="ms-configurator" class="ms-configurator">
      <div class="ms-configurator-title">
        <h3><i class="fa fa-gear"></i> Theme Configurator</h3>
        <a href="javascript:void(0);" class="ms-conf-btn withripple"><i class="zmdi zmdi-close"></i></a>
      </div>
      <div class="panel-group" id="accordion_conf" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="ms-conf-header-color">
            <h4 class="panel-title">
              <a role="button" class="withripple" data-toggle="collapse" href="#ms-collapse-conf-1" aria-expanded="true" aria-controls="ms-collapse-conf-1">
                <i class="zmdi zmdi-invert-colors"></i> Color Selector </a>
            </h4>
          </div>
          <div id="ms-collapse-conf-1" class="card-collapse collapse show" role="tabpanel" aria-labelledby="ms-conf-header-color" data-parent="#accordion_conf">
            <div class="panel-body">
              <div id="color-options" class="ms-colors-container">
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary red" data-color="red">red</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary pink" data-color="pink">pink</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary purple" data-color="purple">purple</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary deep-purple" data-color="deep-purple">deep-purple</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary indigo" data-color="indigo">indigo</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary blue" data-color="blue">blue</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary light-blue active" data-color="light-blue">light-blue</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary cyan" data-color="cyan">cyan</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary teal" data-color="teal">teal</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary green" data-color="green">green</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary light-green" data-color="light-green">light-green</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary lime" data-color="lime">lime</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary yellow" data-color="yellow">yellow</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary amber" data-color="amber">amber</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary orange" data-color="orange">orange</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary deep-orange" data-color="deep-orange">deep-orange</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary brown" data-color="brown">brown</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary grey" data-color="grey">grey</a>
                <a href="javascript:void(0);" class="ms-color-box ms-color-box-primary blue-grey" data-color="blue-grey">blue-grey</a>
              </div>
              <div id="grad-options" class="ms-color-shine">
                <h4 class="no-mb text-center">Color Brightness</h4>
                <span>300</span><span>400</span><span>500</span><span>600</span><span>700</span><span>800</span>
                <a href="javascript:void(0)" data-shine=300 class="ms-color-box grad c300 light-blue">300</a>
                <a href="javascript:void(0)" data-shine=400 class="ms-color-box grad c400 light-blue">400</a>
                <a href="javascript:void(0)" data-shine=500 class="ms-color-box grad c500 light-blue active">500</a>
                <a href="javascript:void(0)" data-shine=600 class="ms-color-box grad c600 light-blue">600</a>
                <a href="javascript:void(0)" data-shine=700 class="ms-color-box grad c700 light-blue">700</a>
                <a href="javascript:void(0)" data-shine=800 class="ms-color-box grad c800 light-blue">800</a>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="ms-conf-header-headers">
            <h4 class="panel-title">
              <a class="collapsed withripple" role="button" data-toggle="collapse" href="#ms-collapse-conf-2" aria-expanded="false" aria-controls="ms-collapse-conf-2">
                <i class="zmdi zmdi-view-compact"></i> Header Styles </a>
            </h4>
          </div>
          <div id="ms-collapse-conf-2" class="card-collapse collapse" role="tabpanel" aria-labelledby="ms-conf-header-headers" data-parent="#accordion_conf">
            <div class="panel-body">
              <!--<h5>Preset Options</h5>
                    <form class="form-inverse ms-conf-radio">
                        <div class="form-group">
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">Default Style
                                </label>
                            </div>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Pure Material
                                </label>
                            </div>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Navbar Mode
                                </label>
                            </div>
                        </div>
                    </form>
                    <h5>Custom Header</h5>-->
              <h6>Header Options</h6>
              <form class="form-inverse ms-conf-radio" id="header-config">
                <div class="form-group">
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customHeader" id="whiteHeader" value="white" checked="cheked"> Light Color </label>
                  </div>
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customHeader" id="primaryHeader" value="primary"> Primary Color </label>
                  </div>
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customHeader" id="darkHeader" value="dark"> Dark Color </label>
                  </div>
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customHeader" id="noHeader" value="hidden"> No Header (Navbar Mode) </label>
                  </div>
                </div>
              </form>
              <h6>Navbar Options</h6>
              <form class="form-inverse ms-conf-radio" id="navbar-config">
                <div class="form-group">
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customNavbar" id="whiteNavbar" value="white" checked=""> Light Color </label>
                  </div>
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customNavbar" id="primaryNavbar" value="primary"> Primary Color </label>
                  </div>
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customNavbar" id="darkNavbar" value="dark"> Dark Color </label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="ms-conf-header-container">
            <h4 class="panel-title">
              <a class="collapsed withripple" role="button" data-toggle="collapse" href="#ms-conf-collapse-3" aria-expanded="false" aria-controls="ms-conf-collapse-3">
                <i class="zmdi zmdi-grid"></i> Container Options </a>
            </h4>
          </div>
          <div id="ms-conf-collapse-3" class="card-collapse collapse" role="tabpanel" aria-labelledby="ms-conf-header-container" data-parent="#accordion_conf">
            <div class="panel-body">
              <form class="form-inverse ms-conf-radio" id="boxed-config">
                <div class="form-group">
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customWidth" id="fullWidth" value="full" checked=""> Full Width </label>
                  </div>
                  <div class="radio radio-primary">
                    <label>
                      <input type="radio" name="customWidth" id="boxedWidth" value="boxed"> Boxed Mode </label>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>
    <div class="ms-site-container">
      <!-- Modal -->
      <div class="modal modal-primary" id="ms-account-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog animated zoomIn animated-3x" role="document">
          <div class="modal-content">
            <div class="modal-header d-block shadow-2dp no-pb">
              <button type="button" class="close d-inline pull-right mt-2" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
              <div class="modal-title text-center">
                <!-- <span class="ms-logo ms-logo-white ms-logo-sm mr-1">M</span> -->
                <h3 class="no-m ms-site-title">COVID-<span>19</span></h3>
              </div>
              <div class="modal-header-tabs">
                <ul class="nav nav-tabs nav-tabs-full nav-tabs-3 nav-tabs-primary" role="tablist">
                  <li class="nav-item" role="presentation"><a href="#ms-login-tab" aria-controls="ms-login-tab" role="tab" data-toggle="tab" class="nav-link active withoutripple"><i class="zmdi zmdi-account"></i> Login</a></li>
                  <li class="nav-item" role="presentation"><a href="#ms-register-tab" aria-controls="ms-register-tab" role="tab" data-toggle="tab" class="nav-link withoutripple"><i class="zmdi zmdi-account-add"></i> Register</a></li>
                  <li class="nav-item" role="presentation"><a href="#ms-recovery-tab" aria-controls="ms-recovery-tab" role="tab" data-toggle="tab" class="nav-link withoutripple"><i class="zmdi zmdi-key"></i> Recovery Pass</a></li>
                </ul>
              </div>
            </div>
            <div class="modal-body">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active show" id="ms-login-tab">
                  <form autocomplete="off">
                    <fieldset>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                          <label class="control-label" for="ms-form-user">Username</label>
                          <input type="text" id="ms-form-user" class="form-control">
                        </div>
                      </div>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                          <label class="control-label" for="ms-form-pass">Password</label>
                          <input type="password" id="ms-form-pass" class="form-control">
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <div class="form-group no-mt">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> Remember Me </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-raised btn-primary pull-right">Login</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                  <div class="text-center">
                    <h3>Login with</h3>
                    <a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-facebook"><i class="zmdi zmdi-facebook"></i> Facebook</a>
                    <a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-twitter"><i class="zmdi zmdi-twitter"></i> Twitter</a>
                    <a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-google"><i class="zmdi zmdi-google"></i> Google</a>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="ms-register-tab">
                  <form>
                    <fieldset>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                          <label class="control-label" for="ms-form-user-r">Username</label>
                          <input type="text" id="ms-form-user-r" class="form-control">
                        </div>
                      </div>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                          <label class="control-label" for="ms-form-email-r">Email</label>
                          <input type="email" id="ms-form-email-r" class="form-control">
                        </div>
                      </div>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                          <label class="control-label" for="ms-form-pass-r">Password</label>
                          <input type="password" id="ms-form-pass-r" class="form-control">
                        </div>
                      </div>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                          <label class="control-label" for="ms-form-pass-rn">Re-type Password</label>
                          <input type="password" id="ms-form-pass-rn" class="form-control">
                        </div>
                      </div>
                      <button class="btn btn-raised btn-block btn-primary">Register Now</button>
                    </fieldset>
                  </form>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="ms-recovery-tab">
                  <fieldset>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <label class="control-label" for="ms-form-user-re">Username</label>
                        <input type="text" id="ms-form-user-re" class="form-control">
                      </div>
                    </div>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                        <label class="control-label" for="ms-form-email-re">Email</label>
                        <input type="email" id="ms-form-email-re" class="form-control">
                      </div>
                    </div>
                    <button class="btn btn-raised btn-block btn-primary">Send Password</button>
                  </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <header class="ms-header ms-header-primary">
        <!--ms-header-primary-->
        <div class="container container-full">
          <div class="ms-title">
            <a href="">
              <!-- <img src="http://techiebros.in/techiebros/2.0/assets/img/demo/logo-header.png" alt=""> -->
              <!-- <span class="ms-logo animated zoomInDown animation-delay-5">M</span> -->
              <h1 class="animated fadeInRight animation-delay-6">COVID-<span>19</span></h1>
            </a>
          </div>
          <div class="header-right">
            <div class="share-menu">
              <ul class="share-menu-list">
                <li class="animated fadeInRight animation-delay-3"><a href="javascript:void(0)" class="btn-circle btn-google"><i class="zmdi zmdi-google"></i></a></li>
                <li class="animated fadeInRight animation-delay-2"><a href="javascript:void(0)" class="btn-circle btn-facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                <li class="animated fadeInRight animation-delay-1"><a href="javascript:void(0)" class="btn-circle btn-twitter"><i class="zmdi zmdi-twitter"></i></a></li>
              </ul>
              <a href="javascript:void(0)" class="btn-circle btn-circle-primary animated zoomInDown animation-delay-7"><i class="zmdi zmdi-share"></i></a>
            </div>
            <a href="javascript:void(0)" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-8" data-toggle="modal" data-target="#ms-account-modal"><i class="zmdi zmdi-account"></i></a>
            <form class="search-form animated zoomInDown animation-delay-9">
              <input id="search-box" type="text" class="search-input" placeholder="Search..." name="q" />
              <label for="search-box"><i class="zmdi zmdi-search"></i></label>
            </form>
            <a href="javascript:void(0)" class="btn-ms-menu btn-circle btn-circle-primary ms-toggle-left animated zoomInDown animation-delay-10"><i class="zmdi zmdi-menu"></i></a>
          </div>
        </div>
      </header>
      <nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-primary">
        <div class="container container-full">
          <div class="navbar-header">
            <a class="navbar-brand" href="">
              <!-- <img src="http://techiebros.in/techiebros/2.0/assets/img/demo/logo-navbar.png" alt=""> -->
              <!-- <span class="ms-logo ms-logo-sm">M</span> -->
              <span class="ms-title">COVID-<strong>19</strong></span>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="ms-navbar">
            
          </div>
          <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu"><i class="zmdi zmdi-menu"></i></a>
        </div> <!-- container -->
      </nav>
      <div class="material-background"></div>
      <div class="container container-full">
        <div class="ms-paper">
          <div class="row">
           
            <div class="col-lg-12 ms-paper-content-container">
              <div class="ms-paper-content">
                <h1>Monitoring</h1>
                <section class="ms-component-section">
                  <h2 class="section-title">Filter Options</h2>
                  <!-- <div class="alert alert-info">
                    <p><i class="zmdi zmdi-info-outline"></i> This is just a sample of the form fields. You can view completed forms in the <strong>Pages section</strong>.</p>
                  </div> -->
                  <form class="form-horizontal" method="POST" autocomplete="off">
                    <fieldset>
                      <!-- <legend>Legend</legend> -->
                      <div class="form-group row">
                        <label for="device_id" autocomplete="false" class="col-lg-2 control-label">User</label>
                        <div class="col-lg-10">
                        	<select id="device_id" name="device_id" class="form-control selectpicker" data-dropup-auto="false">
                            <option disabled="">--Select Person/Device--</option>
        						        <?php
        						        while($device = $result->fetch_assoc()) {
            									$devices[$device['id']] = $device;
            									$selected = $_SESSION['device_id']==$device['id'] ? "selected" : "";
        						          echo "<option value='$device[id]' $selected>$device[name]</option>";
        						        } ?>
                        	</select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="distance" autocomplete="new-password" class="col-lg-2 control-label">Distance(Miles)</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="distance" name="distance" placeholder="Distance" value="<?=$_SESSION['distance']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="start_datetime" class="col-lg-2 control-label">Start Datetime</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="start_datetime" name="start_datetime" placeholder="Start Datetime" value="<?=$_SESSION['start_datetime']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="end_datetime" class="col-lg-2 control-label">End Datetime</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="end_datetime" name="end_datetime" placeholder="End Datetime" value="<?=$_SESSION['end_datetime']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="limit" class="col-lg-2 control-label">Limit</label>
                        <div class="col-lg-10">
                          <input type="number" class="form-control" id="limit" name="limit" placeholder="Limit" value="<?=$_SESSION['limit']?>" max="500">
                        </div>
                      </div>
                      <div class="form-group row justify-content-end">
                        <div class="col-lg-10">
                          <button type="submit" class="btn btn-raised btn-primary">Submit</button>
                          <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </section>
              </div> <!-- ms-paper-content -->
            </div> <!-- col-lg-9 -->
          </div> <!-- row -->
        </div> <!-- ms-paper -->
      </div> <!-- container -->

    	<?php
    	$total_met_users = $spread_found = $spread_found_count = $all_prime_logs = [];
	    if(isset($_POST['device_id']))
	    {
  			$sql = "SELECT id, deviceid, latitude, longitude, servertime FROM tc_positions WHERE deviceid=$_POST[device_id] AND servertime>='$_SESSION[start_datetime]' AND servertime<='$_SESSION[end_datetime]' ORDER BY id DESC"; // LIMIT $_SESSION[limit]
  			$prime_logs_res = $conn->query($sql);
  			while($prime_log = $prime_logs_res->fetch_assoc()) {
  				$all_prime_logs[] = $prime_log;
  			}
  			$log_ids = array_column($all_prime_logs, "id");

  			if(count($log_ids))
  			{
  				$track_sql = "SELECT other.id, other.deviceid, other.latitude, other.longitude, SQRT(
  				    POW(69.1 * (other.latitude - prime.latitude), 2) +
  				    POW(69.1 * (prime.longitude - other.longitude) * COS(other.latitude / 57.3), 2)) AS distance, other.servertime, prime.id as prime_id, prime.deviceid as prime_deviceid, prime.latitude as prime_latitude, prime.longitude as prime_longitude, prime.servertime as prime_servertime
  				FROM tc_positions as other
  				JOIN tc_positions as prime ON prime.deviceid=$_POST[device_id] AND prime.id IN(".implode(",", $log_ids).") AND SUBSTRING(prime.servertime, 1,16)=SUBSTRING(other.servertime, 1,16)
  				WHERE other.deviceid!=$_POST[device_id] AND other.servertime>='$_SESSION[start_datetime]' AND other.servertime<='$_SESSION[end_datetime]' HAVING distance<$_SESSION[distance] ORDER BY distance limit $_SESSION[limit];";
  				//echo "<b>Selected user's recent data:</b> ".json_encode($device)."<br><br>
  				$logs = $conn->query($track_sql);
  				while($log = $logs->fetch_assoc()) {
  					$spread_found["$log[deviceid]$log[latitude]$log[longitude]"] = $log;
  					if(!isset($spread_found["$log[deviceid]$log[latitude]$log[longitude]"]['servertimemin']))
  						$spread_found["$log[deviceid]$log[latitude]$log[longitude]"]['servertimemin'] = $log['servertime'];
  					$spread_found["$log[deviceid]$log[latitude]$log[longitude]"]['servertimemax'] = $log['servertime'];
  					$total_met_users[$log['deviceid']] = "";
  				}

  				//numbering
  				$inc = 0;
  				foreach ($total_met_users as $key => $value) {
  					$total_met_users[$key] = ++$inc;
  				}
	      }
	    } ?>
		<div class="container container-full">
			<div class="ms-paper">
				<div class="row">
					<div class="col-lg-12 ms-paper-content-container">
						<div class="ms-paper-content">
							<h3>Total users met:<?=count($total_met_users)?></h3>
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title"><i class="zmdi zmdi-graduation-cap"></i> Tracking</h3>
								</div>

							    <style>
							      #map {
							        height: 500px;
							      }
							    </style>
								<div id="map"></div>
							    <?php
							    $first_location = $spread_found ? array_values($spread_found)[0] : [];
                  $first_location = !empty($first_location) ? $first_location : ["latitude"=>13.132627777777778, "longitude"=>79.39215999999999];
							    ?>
							    <script>
							      var map;
							      function initMap(){
							        map = new google.maps.Map(
							            document.getElementById('map'),
							            {center: new google.maps.LatLng(<?php echo "$first_location[latitude], $first_location[longitude]";?>), zoom: 16, mapTypeControl: true, navigationControl: true, scrollwheel: true, streetViewControl: true, overviewMapControl:true, rotateControl:true, scaleControl: true, scaleControlOptions: {position: google.maps.ControlPosition.BOTTOM_CENTER} });
							        var iconBase = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

							        <?php
							        $spread_found_json = [];
						        	foreach ($spread_found as $key => $found) {
						        		$spread_found_json[] = "{
							            position: new google.maps.LatLng($found[latitude], $found[longitude]),
							            type: 'parking',
							            content: '<div id=\"content\"> <div id=\"siteNotice\"> </div> <h1 id=\"firstHeading\" class=\"firstHeading\">Normal User:</h1> <div id=\"bodyContent\"> <p><h4><b>User Name:</b>".$devices[$found['deviceid']]['name']."($found[deviceid])</h4></p>  <p><h4><b>User UID:</b> ".$devices[$found['deviceid']]['uniqueid']."</h4></p>  <p><h4><b>DateTime:</b> $found[servertime]</h4></p>  <p><h4><b>Location:</b> ($found[latitude], $found[longitude])</h4></p> </div> </div>',
							            numbering:".$total_met_users[$found['deviceid']].",

							            prime_position:new google.maps.LatLng($found[prime_latitude], $found[prime_longitude]),
							            prime_type: 'info',
							            prime_content: '<div id=\"content\"> <div id=\"siteNotice\"> </div> <h1 id=\"firstHeading\" class=\"firstHeading\">Infected User:</h1> <div id=\"bodyContent\"> <p><h4><b>User Name:</b> ".$devices[$found['prime_deviceid']]['name']."($found[prime_deviceid])</h4></p>  <p><h4><b>User UID:</b> ".$devices[$found['prime_deviceid']]['uniqueid']."</h4></p>  <p><h4><b>DateTime:</b> $found[prime_servertime]</h4></p>  <p><h4><b>Location:</b> ($found[prime_latitude], $found[prime_longitude])</h4></p> </div> </div>',
							          }";
						        	}
							        echo "var spread_found_json = [".implode(",", $spread_found_json)."];";
						        	?>
							        
							        //Create line
							        <?php
							        $all_prime_logs_json = [];
							        foreach($all_prime_logs as $log) {
							        	$all_prime_logs_json[] = "{lat: $log[latitude], lng: $log[longitude]}";
							        }
							        echo "var flightPlanCoordinates = [".implode(",", $all_prime_logs_json)."];"
							        ?>
							        var flightPath = new google.maps.Polyline({
							          path: flightPlanCoordinates,
							          geodesic: true,
							          strokeColor: '#FF0000',
							          strokeOpacity: 1.0,
							          strokeWeight: 4
							        });
							        flightPath.setMap(map);

							        // Create markers.
							        for (var i = 0; i < spread_found_json.length; i++) {
							        	/*//prime users
							        	var marker = new google.maps.Marker({
											position: spread_found_json[i].prime_position,
											icon: 'http://chart.apis.google.com/chart?chst=d_map_spin&chld=1|0|FF0000|12|_|',
											map: map
										});
							          	
							          	var content = spread_found_json[i].prime_content;
										var infowindow = new google.maps.InfoWindow();
										google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
										    return function() {
										       infowindow.setContent(content);
										       infowindow.open(map,marker);
										    };
										})(marker,content,infowindow));*/

										//normal users
										var marker = new google.maps.Marker({
											position: spread_found_json[i].position,
											icon: 'http://chart.apis.google.com/chart?chst=d_map_spin&chld=1|0|0000FF|12|_|'+spread_found_json[i].numbering,
											map: map
										});
							          	
							          	var content = spread_found_json[i].content;
										var infowindow = new google.maps.InfoWindow();
										google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
										    return function() {
										       infowindow.setContent(content);
										       infowindow.open(map,marker);
										    };
										})(marker,content,infowindow));
							        }
							    }
							    </script>
							    <script async defer
							    src="https://maps.googleapis.com/maps/api/js?key=<?=$key?>&callback=initMap">
							    </script>
							</div>
						</div>
					</div>
				</div>
			</div>
    </div>

      <div class="container container-full">
        <div class="ms-paper">
          <div class="row">
           
            <div class="col-lg-12 ms-paper-content-container">
              <div class="ms-paper-content">
	              <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="zmdi zmdi-graduation-cap"></i> Tracking</h3>
                    </div>
                    <table class="table table-no-border table-striped">
                      <thead>
                        <tr>
                          <td title="Infected User Datetime">Infected User Datetime</td>
                          <td>Name</td>
                          <td>Id</td>
                          <td>User Id</td>
                          <td>Location(Lat, Lon)</td>
                          <td>Distance(Miles)</td>
                          <td>Contact Duration (Min)</td>
                          <td>Datetime</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($spread_found as $log) {
							            echo "<tr> <td title='$log[prime_id]'>$log[prime_servertime]</td> <td>".$devices[$log['deviceid']]['name']."</td> <td>$log[id]</td> <td>$log[deviceid]</td> <td>($log[latitude], $log[longitude])</td> <td>".number_format($log['distance'], 3, '.', '')."</td>  <td>".$datetime_difference($log['servertimemin'], $log['servertimemax'])."</td>  <td>$log[servertime]</td> </tr>"; //
                        } ?>
                      </tbody>
                    </table>
                  </div> <!-- /example -->
                  <?php
                  if(isset($track_sql))
                  	echo "<b>Query:</b> $track_sql<br><br>";
                  ?>
              </div> <!-- ms-paper-content -->
            </div> <!-- col-lg-9 -->
          </div> <!-- row -->
        </div> <!-- ms-paper -->
      </div> <!-- container -->


      <aside class="ms-footbar">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 ms-footer-col">
              <div class="ms-footbar-block">
                <h3 class="ms-footbar-title">Sitemap</h3>
                <ul class="list-unstyled ms-icon-list three_cols">
                  <li><a href=""><i class="zmdi zmdi-home"></i> Home</a></li>
                  <li><a href="page-blog.html"><i class="zmdi zmdi-edit"></i> Blog</a></li>
                  <li><a href="page-blog.html"><i class="zmdi zmdi-image-o"></i> Portafolio</a></li>
                  <li><a href="portfolio-filters_sidebar.html"><i class="zmdi zmdi-case"></i> Works</a></li>
                  <li><a href="page-timeline_left2.html"><i class="zmdi zmdi-time"></i> Timeline</a></li>
                  <li><a href="page-pricing.html"><i class="zmdi zmdi-money"></i> Pricing</a></li>
                  <li><a href="page-about.html"><i class="zmdi zmdi-favorite-outline"></i> About Us</a></li>
                  <li><a href="page-team2.html"><i class="zmdi zmdi-accounts"></i> Our Team</a></li>
                  <li><a href="page-services.html"><i class="zmdi zmdi-face"></i> Services</a></li>
                  <li><a href="page-faq2.html"><i class="zmdi zmdi-help"></i> FAQ</a></li>
                  <li><a href="page-login2.html"><i class="zmdi zmdi-lock"></i> Login</a></li>
                  <li><a href="page-contact.html"><i class="zmdi zmdi-email"></i> Contact</a></li>
                </ul>
              </div>
              <div class="ms-footbar-block">
                <h3 class="ms-footbar-title">Subscribe</h3>
                <p class="">Lorem ipsum Amet fugiat elit nisi anim mollit minim labore ut esse Duis ullamco ad dolor veniam velit.</p>
                <form>
                  <div class="form-group label-floating mt-2 mb-1">
                    <div class="input-group ms-input-subscribe">
                      <label class="control-label" for="ms-subscribe"><i class="zmdi zmdi-email"></i> Email Adress</label>
                      <input type="email" id="ms-subscribe" class="form-control">
                    </div>
                  </div>
                  <button class="ms-subscribre-btn" type="button">Subscribe</button>
                </form>
              </div>
            </div>
            <div class="col-lg-5 col-md-7 ms-footer-col ms-footer-alt-color">
              <div class="ms-footbar-block">
                <h3 class="ms-footbar-title text-center mb-2">Last Articles</h3>
                <div class="ms-footer-media">
                  <div class="media">
                    <div class="media-left media-middle">
                      <a href="javascript:void(0)">
                        <img class="media-object media-object-circle" src="http://techiebros.in/techiebros/2.0/assets/img/demo/p75.jpg" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading"><a href="javascript:void(0)">Lorem ipsum dolor sit expedita cumque amet consectetur adipisicing repellat</a></h4>
                      <div class="media-footer">
                        <span><i class="zmdi zmdi-time color-info-light"></i> August 18, 2016</span>
                        <span><i class="zmdi zmdi-folder-outline color-warning-light"></i> <a href="javascript:void(0)">Design</a></span>
                      </div>
                    </div>
                  </div>
                  <div class="media">
                    <div class="media-left media-middle">
                      <a href="javascript:void(0)">
                        <img class="media-object media-object-circle" src="http://techiebros.in/techiebros/2.0/assets/img/demo/p75.jpg" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading"><a href="javascript:void(0)">Labore ut esse Duis consectetur expedita cumque ullamco ad dolor veniam velit</a></h4>
                      <div class="media-footer">
                        <span><i class="zmdi zmdi-time color-info-light"></i> August 18, 2016</span>
                        <span><i class="zmdi zmdi-folder-outline color-warning-light"></i> <a href="javascript:void(0)">News</a></span>
                      </div>
                    </div>
                  </div>
                  <div class="media">
                    <div class="media-left media-middle">
                      <a href="javascript:void(0)">
                        <img class="media-object media-object-circle" src="http://techiebros.in/techiebros/2.0/assets/img/demo/p75.jpg" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading"><a href="javascript:void(0)">voluptates deserunt ducimus expedita cumque quaerat molestiae labore</a></h4>
                      <div class="media-footer">
                        <span><i class="zmdi zmdi-time color-info-light"></i> August 18, 2016</span>
                        <span><i class="zmdi zmdi-folder-outline color-warning-light"></i> <a href="javascript:void(0)">Productivity</a></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-5 ms-footer-col ms-footer-text-right">
              <div class="ms-footbar-block">
                <div class="ms-footbar-title">
                  <span class="ms-logo ms-logo-white ms-logo-sm mr-1">M</span>
                  <h3 class="no-m ms-site-title">Material<span>Style</span></h3>
                </div>
                <address class="no-mb">
                  <p><i class="color-danger-light zmdi zmdi-pin mr-1"></i> 795 Folsom Ave, Suite 600</p>
                  <p><i class="color-warning-light zmdi zmdi-map mr-1"></i> San Francisco, CA 94107</p>
                  <p><i class="color-info-light zmdi zmdi-email mr-1"></i> <a href="mailto:joe@example.com">example@domain.com</a></p>
                  <p><i class="color-royal-light zmdi zmdi-phone mr-1"></i>+34 123 456 7890 </p>
                  <p><i class="color-success-light fa fa-fax mr-1"></i>+34 123 456 7890 </p>
                </address>
              </div>
              <div class="ms-footbar-block">
                <h3 class="ms-footbar-title">Social Media</h3>
                <div class="ms-footbar-social">
                  <a href="javascript:void(0)" class="btn-circle btn-facebook"><i class="zmdi zmdi-facebook"></i></a>
                  <a href="javascript:void(0)" class="btn-circle btn-twitter"><i class="zmdi zmdi-twitter"></i></a>
                  <a href="javascript:void(0)" class="btn-circle btn-youtube"><i class="zmdi zmdi-youtube-play"></i></a><br>
                  <a href="javascript:void(0)" class="btn-circle btn-google"><i class="zmdi zmdi-google"></i></a>
                  <a href="javascript:void(0)" class="btn-circle btn-instagram"><i class="zmdi zmdi-instagram"></i></a>
                  <a href="javascript:void(0)" class="btn-circle btn-github"><i class="zmdi zmdi-github"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside>
      <footer class="ms-footer">
        <div class="container">
          <p>Copyright &copy; 2020</p>
        </div>
      </footer>
      <div class="btn-back-top">
        <a href="#" data-scroll id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised "><i class="zmdi zmdi-long-arrow-up"></i></a>
      </div>
    </div> <!-- ms-site-container -->
    <div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
      <div class="sb-slidebar-container">
        <header class="ms-slidebar-header">
          <div class="ms-slidebar-login">
            <a href="javascript:void(0)" class="withripple"><i class="zmdi zmdi-account"></i> Login</a>
            <a href="javascript:void(0)" class="withripple"><i class="zmdi zmdi-account-add"></i> Register</a>
          </div>
          <div class="ms-slidebar-title">
            <form class="search-form">
              <input id="search-box-slidebar" type="text" class="search-input" placeholder="Search..." name="q" />
              <label for="search-box-slidebar"><i class="zmdi zmdi-search"></i></label>
            </form>
            <div class="ms-slidebar-t">
              <!-- <span class="ms-logo ms-logo-sm">M</span> -->
              <h3>COVID-<span>19</span></h3>
            </div>
          </div>
        </header>
        <ul class="ms-slidebar-menu" id="slidebar-menu" role="tablist" aria-multiselectable="true">
          <li class="card" role="tab" id="sch1">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc1" aria-expanded="false" aria-controls="sc1">
              <i class="zmdi zmdi-home"></i> Home </a>
            <ul id="sc1" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch1" data-parent="#slidebar-menu">
              <li><a href="">Default Home</a></li>
              <li><a href="home-generic-2.html">Home Black Slider</a></li>
              <li><a href="home-landing.html">Home Landing Intro</a></li>
              <li><a href="home-landing3.html">Home Landing Video</a></li>
              <li><a href="home-shop.html">Home Shop 1</a></li>
            </ul>
          </li>
          <li class="card" role="tab" id="sch2">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc2" aria-expanded="false" aria-controls="sc2">
              <i class="zmdi zmdi-desktop-mac"></i> Pages </a>
            <ul id="sc2" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch2" data-parent="#slidebar-menu">
              <li><a href="page-about.html">About US</a></li>
              <li><a href="page-team.html">Our Team</a></li>
              <li><a href="page-product.html">Products</a></li>
              <li><a href="page-services.html">Services</a></li>
              <li><a href="page-faq.html">FAQ</a></li>
              <li><a href="page-timeline_left.html">Timeline</a></li>
              <li><a href="page-contact.html">Contact Option</a></li>
              <li><a href="page-login.html">Login</a></li>
              <li><a href="page-pricing.html">Pricing</a></li>
              <li><a href="page-coming.html">Coming Soon</a></li>
            </ul>
          </li>
          <li class="card" role="tab" id="sch4">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc4" aria-expanded="false" aria-controls="sc4">
              <i class="zmdi zmdi-edit"></i> Blog </a>
            <ul id="sc4" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch4" data-parent="#slidebar-menu">
              <li><a href="blog-sidebar.html">Blog Sidebar 1</a></li>
              <li><a href="blog-sidebar2.html">Blog Sidebar 2</a></li>
              <li><a href="blog-masonry.html">Blog Masonry 1</a></li>
              <li><a href="blog-masonry2.html">Blog Masonry 2</a></li>
              <li><a href="blog-full.html">Blog Full Page 1</a></li>
              <li><a href="blog-full2.html">Blog Full Page 2</a></li>
              <li><a href="blog-post.html">Blog Post 1</a></li>
              <li><a href="blog-post2.html">Blog Post 2</a></li>
            </ul>
          </li>
          <li class="card" role="tab" id="sch5">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc5" aria-expanded="false" aria-controls="sc5">
              <i class="zmdi zmdi-shopping-basket"></i> E-Commerce </a>
            <ul id="sc5" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch5" data-parent="#slidebar-menu">
              <li><a href="ecommerce-filters.html">E-Commerce Sidebar</a></li>
              <li><a href="ecommerce-filters-full.html">E-Commerce Sidebar Full</a></li>
              <li><a href="ecommerce-filters-full2.html">E-Commerce Topbar Full</a></li>
              <li><a href="ecommerce-item.html">E-Commerce Item</a></li>
              <li><a href="ecommerce-cart.html">E-Commerce Cart</a></li>
            </ul>
          </li>
          <li class="card" role="tab" id="sch6">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc6" aria-expanded="false" aria-controls="sc6">
              <i class="zmdi zmdi-collection-image-o"></i> Portfolio </a>
            <ul id="sc6" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch6" data-parent="#slidebar-menu">
              <li><a href="portfolio-filters_sidebar.html">Portfolio Sidebar Filters</a></li>
              <li><a href="portfolio-filters_topbar.html">Portfolio Topbar Filters</a></li>
              <li><a href="portfolio-filters_sidebar_fluid.html">Portfolio Sidebar Fluid</a></li>
              <li><a href="portfolio-filters_topbar_fluid.html">Portfolio Topbar Fluid</a></li>
              <li><a href="portfolio-cards.html">Porfolio Cards</a></li>
              <li><a href="portfolio-masonry.html">Porfolio Masonry</a></li>
              <li><a href="portfolio-item.html">Portfolio Item 1</a></li>
              <li><a href="portfolio-item2.html">Portfolio Item 2</a></li>
            </ul>
          </li>
          <li>
            <a class="link" href="component-typography.html"><i class="zmdi zmdi-view-compact"></i> UI Elements</a>
          </li>
          <li>
            <a class="link" href="page-all.html"><i class="zmdi zmdi-link"></i> All Pages</a>
          </li>
        </ul>
        <div class="ms-slidebar-social ms-slidebar-block">
          <h4 class="ms-slidebar-block-title">Social Links</h4>
          <div class="ms-slidebar-social">
            <a href="javascript:void(0)" class="btn-circle btn-circle-raised btn-facebook"><i class="zmdi zmdi-facebook"></i> <span class="badge-pill badge-pill-pink">12</span>
              <div class="ripple-container"></div>
            </a>
            <a href="javascript:void(0)" class="btn-circle btn-circle-raised btn-twitter"><i class="zmdi zmdi-twitter"></i> <span class="badge-pill badge-pill-pink">4</span>
              <div class="ripple-container"></div>
            </a>
            <a href="javascript:void(0)" class="btn-circle btn-circle-raised btn-google"><i class="zmdi zmdi-google"></i>
              <div class="ripple-container"></div>
            </a>
            <a href="javascript:void(0)" class="btn-circle btn-circle-raised btn-instagram"><i class="zmdi zmdi-instagram"></i>
              <div class="ripple-container"></div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <script src="http://techiebros.in/techiebros/2.0/assets/js/plugins.min.js"></script>
    <script src="http://techiebros.in/techiebros/2.0/assets/js/app.min.js"></script>
    <script src="http://techiebros.in/techiebros/2.0/assets/js/configurator.min.js"></script>
    <script>
      (function(i, s, o, g, r, a, m)
      {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function()
        {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', 'https://www.google-analytics.com/analytics.js.disabled', 'ga');
      ga('create', 'UA-90917746-2', 'auto');
      ga('send', 'pageview');
    </script>
  </body>
</html>

<?php
function datetime_difference($timeFirst="", $timeSecond="")
{
	$timeFirst  = strtotime($timeFirst);
	$timeSecond = strtotime($timeSecond);
	$differenceInSeconds = $timeSecond - $timeFirst;
	return $differenceInSeconds;
} ?>