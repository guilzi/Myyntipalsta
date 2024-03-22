<?php

// Aloitetaan istunnot.
session_start();

// Suoritetaan projektin alustusskripti.
require_once '../src/init.php';

// Haetaan kirjautuneen käyttäjän tiedot.
  if (isset($_SESSION['user'])) {
    require_once MODEL_DIR . 'henkilo.php';
    $loggeduser = haeHenkilo($_SESSION['user']);
  } else {
    $loggeduser = NULL;
}

// Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
// lyhentynyt muotoon /tavara.
$request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request = strtok($request, '?');

// Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
$templates = new League\Plates\Engine(TEMPLATE_DIR);


// Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava
// käsittelijä.
switch ($request) {
  case '/':
  case '/tavarat':
    require_once MODEL_DIR . 'tavara.php';
    $tavarat = haeTapahtumat();
        echo $templates->render('tavarat',['tavarat' => $tavarat]);
    break;
  case '/tavara':
    require_once MODEL_DIR . 'tavara.php';
    require_once MODEL_DIR . 'osto.php';
    $tavara = haeTapahtuma($_GET['id']);
    if ($tavara) {
      if ($loggeduser) {
          $osto = haeIlmoittautuminen($loggeduser['idhenkilo'],$tavara['idtavara']);
      } else {
          $osto = NULL;
         }
      echo $templates->render('tavara',['tavara' => $tavara,
                                             'osto' => $osto,
                                             'loggeduser' => $loggeduser]);
      } else {
        echo $templates->render('tavaranotfound');
    }
    break;
    case '/lisaa_tili':
      if (isset($_POST['laheta'])) {
        $formdata = cleanArrayData($_POST);
        require_once CONTROLLER_DIR . 'tili.php';
        $tulos = lisaaTili($formdata,$config['urls']['baseUrl']);
        if ($tulos['status'] == "200") {
          echo $templates->render('tili_luotu', ['formdata' => $formdata]);
          break;
        }
          echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
          break;
        } else {
          echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
          break;
        }
        case "/kirjaudu":
          if (isset($_POST['laheta'])) {
            require_once CONTROLLER_DIR . 'kirjaudu.php';
            if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
              require_once MODEL_DIR . 'henkilo.php';
              $user = haeHenkilo($_POST['email']);
              if ($user['vahvistettu']) {
                session_regenerate_id();
                $_SESSION['user'] = $user['email'];
                header("Location: " . $config['urls']['baseUrl']);
              } else {
                echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Tili on vahvistamatta! Ole hyvä, ja vahvista tili sähköpostissa olevalla linkillä.']]);
              }
            } else {
              echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana!']]);
            }
          } else {
            echo $templates->render('kirjaudu', [ 'error' => []]);
          }
          break;
    case '/osto':
      if ($_GET['id']) {
        require_once MODEL_DIR . 'osto.php';
        $idtavara = $_GET['id'];
          if ($loggeduser) {
            lisaaIlmoittautuminen($loggeduser['idhenkilo'],$idtavara);
          }
          header("Location: tavara?id=$idtavara");
          } else {
          header("Location: tavarat");
        }
    break;
    case '/peru':
      if ($_GET['id']) {
        require_once MODEL_DIR . 'osto.php';
        $idtavara = $_GET['id'];
        if ($loggeduser) {
          poistaIlmoittautuminen($loggeduser['idhenkilo'],$idtavara);
        }
        header("Location: tavara?id=$idtavara");
      } else {
        header("Location: tavarat");  
      }
      break;
      case '/ostohistoria':
        if ($loggeduser) {
            require_once MODEL_DIR . 'osto.php';
            $idhenkilo = $loggeduser['idhenkilo'];
            $ostohistoria = ostoHistoria($idhenkilo);
            echo $templates->render('ostohistoria', ['ostohistoria' => $ostohistoria]);
        } else {
            header("Location: kirjaudu.php");
        }
        break;
    case "/logout":
        require_once CONTROLLER_DIR . 'kirjaudu.php';
        logout();
        header("Location: " . $config['urls']['baseUrl']);
        break;
    
    case "/vahvista":
          if (isset($_GET['key'])) {
            $key = $_GET['key'];
            require_once MODEL_DIR . 'henkilo.php';
            if (vahvistaTili($key)) {
              echo $templates->render('tili_aktivoitu');
            } else {
              echo $templates->render('tili_aktivointi_virhe');
            }
          } else {
            header("Location: " . $config['urls']['baseUrl']);
          }
          break;
          case "/tilaa_vaihtoavain":
            $formdata = cleanArrayData($_POST);
            // Tarkistetaan, onko lomakkeelta lähetetty tietoa.
            if (isset($formdata['laheta'])) {    
        
              // TODO vaihtoavaimen tilauskäsittely
        
            } else {
              // Lomakeelta ei ole lähetetty tietoa, tulostetaan lomake.
              echo $templates->render('tilaa_vaihtoavain_lomake');
            }
            break;
    default:
      echo $templates->render('notfound');
  }    

?> 