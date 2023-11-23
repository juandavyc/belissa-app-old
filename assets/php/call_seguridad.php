 <?php class dXhLn
    {
        protected static $axbom = array();
        protected static $yIx0Q = array();
        protected static $R3dd0 = 0;
        protected static $Bo6bH = 0;
        public function __construct()
        {
            
        }
        public function init()
        {
            if (!defined('ROOT')) {
                define("ROOT", $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
            }
            if (!defined('DOCUMENT_ROOT')) {
                define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT'] . "");
            }
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
        }
        public function r2vYe($UhdWg, $yau2H)
        {
            if ($UhdWg != $yau2H) {
                echo "<script> window.location = '" . ROOT . "/mantenimiento.php';</script>";
            }
        }
        public function S8Lm0($PiOf7, $xa6Tp)
        {
            goto kDZoH;
            eAVkB:
            echo "\x3c\x62\162\x3e\x3c\142\x72\76\x3a\72\40\155\x6f\x64\165\154\157\113\145\171\163\x20\x3a\72\74\x62\x72\76\x3c\142\x72\76";
            goto Cfdp7;
            M1JL6:
            $_SESSION["\x63\163\x72\146\x5f\164\x6f\153\145\x6e"] = bin2hex(random_bytes(32));
            goto QO2hl;
            rTgoA:
            echo "\74\x62\x72\76\x3c\x62\x72\76\72\72\x20\x5f\123\x45\123\x53\111\117\116\40\72\72\74\142\162\76\x3c\x62\162\76";
            goto LlYql;
            Cfdp7:
            var_dump(self::$yIx0Q);
            goto JBY5_;
            Wofml:
            pR8ej:
            goto UPwyL;
            lVvGk:
            if (!(isset($_GET["\x70\x6f\163\x2d\x73\145\163\163\x69\157\x6e\x2d\163\145\x67\165\x72\x61"]) && isset($_GET["\x76\x61\154\165\145\x2d\x73\x65\163\x73\151\x6f\156\x2d\x73\145\x67\x75\162\141"]))) {
                goto XdyvH;
            }
            goto S_82a;
            wLnBd:
            atMsD:
            goto bvBKk;
            CrZS8:
            goto EkLhj;
            goto Wxxq7;
            bvBKk:
            self::$Bo6bH = $xa6Tp;
            goto xOOKU;
            QO2hl:
            kIo15:
            goto ZaRyq;
            Jfr3G:
            CSc_p:
            goto UY3Pi;
            qMFyz:
            echo "\x3c\x62\x72\x3e\x3c\142\162\76\x3a\72\x20\x63\x6f\x75\x6e\x74\x53\x65\163\x73\151\157\x6e\x20\72\72\x3c\142\x72\76\x3c\x62\162\x3e";
            goto eB22c;
            Attq5:
            hyFhD:
            goto x0JaW;
            fNVdH:
            $_SESSION["\x73\145\163\163\x69\x6f\156\x5f\165\163\x65\x72"][0] = $_GET["\151\156\151\143\x69\141\162\55\163\145\163\163\151\x6f\156\x2d\163\x65\147\x75\x72\141"];
            goto Vbrg5;
            G9woI:
            session_unset();
            goto a6tBd;
            MLZ3Q:
            if (!empty($_SESSION["\x63\163\162\146\x5f\x74\x6f\x6b\145\x6e"])) {
                goto kIo15;
            }
            goto M1JL6;
            FmO6Z:
            echo "\x3c\142\162\76\x3c\x62\162\76\72\x3a\40\155\157\x64\165\154\157\x53\x65\x73\163\151\x6f\156\x4b\x65\171\x73\40\72\x3a\x3c\142\x72\x3e\x3c\x62\162\76";
            goto wgTHO;
            UY3Pi:
            if (!isset($_GET["\143\x65\x72\162\141\162\55\163\145\x73\163\151\x6f\156\x2d\x73\145\x67\x75\162\141"])) {
                goto pR8ej;
            }
            goto G9woI;
            ZaRyq:
            kZpTx:
            goto lVvGk;
            Yb14k:
            if (!isset($_GET["\144\165\155\x70\55\x73\x65\163\163\x69\157\x6e\x2d\163\145\x67\x75\162\141"])) {
                goto CSc_p;
            }
            goto rTgoA;
            Vbrg5:
            $_SESSION["\x73\x65\163\163\x69\x6f\156\x5f\165\163\x65\162"][self::$R3dd0] = json_encode(self::$axbom);
            goto MLZ3Q;
            a6tBd:
            session_destroy();
            goto Wofml;
            LlYql:
            var_dump($_SESSION);
            goto FmO6Z;
            kDZoH:
            foreach ($PiOf7 as $XwqOa => $Q7OkG) {
                array_push(self::$yIx0Q, $XwqOa);
                Dk7sZ:
            }
            goto wLnBd;
            eB22c:
            echo self::$Bo6bH;
            goto Jfr3G;
            JBY5_:
            echo "\74\x62\162\76\x3c\142\x72\x3e\x3a\72\x20\155\157\144\165\x6c\x6f\123\145\163\x73\x69\157\x6e\120\x6f\163\x20\72\72\x3c\142\x72\76\x3c\142\162\76";
            goto KXKXx;
            TSpRH:
            if (!($rUP04 < $xa6Tp)) {
                goto yIovb;
            }
            goto s8v9Z;
            s8v9Z:
            $_SESSION["\x73\145\x73\163\x69\x6f\x6e\137\165\163\x65\162"][$rUP04] = 1;
            goto Attq5;
            Wxxq7:
            yIovb:
            goto fNVdH;
            gusN1:
            $rUP04 = 0;
            goto crsmn;
            x0JaW:
            $rUP04++;
            goto CrZS8;
            xOOKU:
            if (!isset($_GET["\151\156\x69\143\x69\141\162\55\163\x65\x73\163\x69\157\156\55\163\x65\147\x75\162\x61"])) {
                goto kZpTx;
            }
            goto gusN1;
            crsmn:
            EkLhj:
            goto TSpRH;
            rTMgn:
            XdyvH:
            goto Yb14k;
            S_82a:
            $_SESSION["\163\x65\x73\163\x69\x6f\x6e\x5f\165\x73\x65\162"][$_GET["\x70\x6f\163\55\163\x65\x73\163\151\x6f\156\55\x73\x65\147\x75\x72\141"]] = $_GET["\x76\x61\x6c\165\145\55\163\145\163\x73\x69\157\156\55\x73\145\147\165\x72\141"];
            goto rTMgn;
            KXKXx:
            var_dump(self::$R3dd0);
            goto qMFyz;
            wgTHO:
            var_dump(self::$axbom);
            goto eAVkB;
            UPwyL:
        }
        public function p3poW($YuVFJ, $xa6Tp)
        {
            self::$axbom = json_decode($YuVFJ, true);
            self::$R3dd0 = $xa6Tp;
        }
        public function XmDD6($PiOf7)
        {
            return $this->{$sPB84};
        }
        public function cM8aZ($pEz6t)
        {
            goto QKwM1;
            qGPaf:
            goto p8KfB;
            goto uZRki;
            QKwM1:
            if (in_array($pEz6t, self::$axbom)) {
                goto olx34;
            }
            goto JGyTa;
            jO85P:
            p8KfB:
            goto S8e1t;
            uZRki:
            olx34:
            goto r9njw;
            r9njw:
            return array("\163\x74\x61\164\x75\163" => true, "\x6d\145\163\163\x61\147\x65" => "\101\x63\143\145\x73\x6f\x20\x61\x75\164\157\x72\x69\x7a\141\144\157");
            goto jO85P;
            JGyTa:
            return array("\163\164\x61\x74\165\x73" => false, "\155\x65\163\163\x61\147\145" => "\101\143\x63\x65\163\x6f\40\156\157\x20\x61\165\164\157\162\x69\x7a\x61\x64\x6f\40\x61\x20\145\163\x74\x65\x20\x6d\x6f\144\165\x6c\x6f", "\x73\x74\x61\164\165\x73\x54\x65\170\x74" => "\x6e\157\137\141\165\164\x6f\x72\x69\x7a\x61\x64\157");
            goto qGPaf;
            S8e1t:
        }
        public function Xr2L7($bpWoK)
        {
            goto em4tu;
            QpE7e:
            return $pZTMo;
            goto A9bKP;
            H6Lpt:
            $pZTMo .= "\74\156\x61\166\40\151\x64\75\x22\155\145\156\165\42\x3e\40\74\150\145\x61\x64\145\x72\x20\x63\154\141\163\x73\x3d\42\155\141\152\157\x72\42\x3e\40\x3c\150\x32\x3e\115\x45\116\303\232\74\57\150\x32\76\x20\x3c\x2f\150\x65\x61\x64\x65\162\x3e\40";
            goto ZD1nR;
            gVTLn:
            $pZTMo .= "\74\x6c\151\x20\151\144\75\42\x6d\x65\x6e\165\x2d\x63\x65\x72\162\141\162\x22\76";
            goto LL64A;
            dPHNo:
            $pZTMo .= "\74\57\154\x69\76";
            goto ioaCG;
            ZD1nR:
            $pZTMo .= "\x3c\x75\x6c\76";
            goto D3c7y;
            D3c7y:
            foreach ($bpWoK as $XwqOa => $Q7OkG) {
                goto yzTz4;
                hzmns:
                $pZTMo .= "\x3c\x61\40\x68\162\x65\x66\75\x22" . $Q7OkG["\x75\162\154"] . "\x22\x20\143\154\x61\x73\163\x3d\x22" . $Q7OkG["\151\143\x6f\x6e\157"] . "\x22\x3e\40" . $Q7OkG["\x6e\157\155\142\x72\x65"] . "\74\x2f\141\76";
                goto A25On;
                IP0GW:
                $pZTMo .= "\74\163\x70\141\x6e\x20\143\x6c\x61\163\x73\75\x22\157\160\x65\x6e\145\162\x22\x3e\x20" . $Q7OkG["\x6e\x6f\155\x62\162\145"] . "\x20\74\57\x73\160\x61\156\76";
                goto u84Cx;
                WfoG6:
                i8dsv:
                goto YVlvw;
                i8LfX:
                $pZTMo .= "\x3c\x6c\151\40\x69\x64\75\x22\155\x65\156\165\55" . $Q7OkG["\156\x6f\155\x62\162\x65"] . "\x22\x3e";
                goto hzmns;
                A25On:
                $pZTMo .= "\74\x2f\x6c\x69\x3e";
                goto jPkdk;
                jPkdk:
                goto i8dsv;
                goto iBujG;
                QdS5a:
                $pZTMo .= "\x3c\154\151\40\151\144\75\x22\155\145\x6e\x75\55" . $Q7OkG["\156\157\155\x62\162\145"] . "\x22\x3e";
                goto IP0GW;
                fhgMj:
                $pZTMo .= "\x3c\x2f\x75\x6c\76";
                goto sW69j;
                u84Cx:
                $pZTMo .= "\74\165\x6c\x3e";
                goto wR42r;
                sW69j:
                $pZTMo .= "\x3c\x2f\x6c\x69\x3e";
                goto WfoG6;
                YVlvw:
                wrftf:
                goto zBhzK;
                zBhzK:
                OHGuQ:
                goto N9z57;
                yRZoy:
                eAA8G:
                goto fhgMj;
                iBujG:
                NI9lr:
                goto QdS5a;
                yzTz4:
                if (!in_array($XwqOa, self::$axbom)) {
                    goto wrftf;
                }
                goto tNrxr;
                tNrxr:
                if (isset($Q7OkG["\x73\x75\142\55\155\x65\156\165"])) {
                    goto NI9lr;
                }
                goto i8LfX;
                wR42r:
                foreach ($Q7OkG["\163\165\x62\55\x6d\145\x6e\x75"] as $wxxVk => $OM0Pj) {
                    goto pJXKf;
                    dF6c8:
                    QFwur:
                    goto LF9ni;
                    pJXKf:
                    $pZTMo .= "\74\x6c\151\x3e";
                    goto MEd_Z;
                    MEd_Z:
                    $pZTMo .= "\74\x61\x20\150\162\x65\146\x3d\42" . $OM0Pj["\165\162\154"] . "\x22\x20\x63\154\x61\163\x73\75\x22" . $OM0Pj["\x69\x63\157\x6e\157"] . "\x22\x3e\40" . $OM0Pj["\156\157\x6d\x62\162\x65"] . "\74\x2f\141\x3e";
                    goto bDf1Q;
                    bDf1Q:
                    $pZTMo .= "\x3c\x2f\154\151\76";
                    goto dF6c8;
                    LF9ni:
                }
                goto yRZoy;
                N9z57:
            }
            goto AFtqN;
            Tuy4t:
            $pZTMo .= "\74\57\x6e\x61\x76\76\40\x3c\x2f\144\x69\166\76\x20\74\57\x64\151\166\76";
            goto QpE7e;
            Dz_3y:
            $pZTMo .= "\74\150\61\76\x20\74\141\40\150\162\x65\146\75\42\57\42\x3e\x20\x43\141\154\154\40\x43\x65\x6e\x74\145\162\74\x2f\141\x3e\x20\x3c\x2f\150\61\76\x20\74\57\x73\x65\x63\x74\151\x6f\156\x3e";
            goto H6Lpt;
            em4tu:
            $pZTMo = "\74\x64\x69\x76\x20\151\144\75\42\x73\151\144\x65\142\141\x72\x22\x3e\40\74\x64\151\166\40\143\154\x61\x73\163\75\42\151\x6e\x6e\145\162\x22\76\40\x3c\163\x65\x63\x74\151\157\156\40\x69\144\x3d\x22\x6c\157\x67\157\42\x3e";
            goto Dz_3y;
            ioaCG:
            $pZTMo .= "\74\57\x75\x6c\x3e";
            goto Tuy4t;
            LL64A:
            $pZTMo .= "\x3c\x61\x20\x68\x72\145\146\x3d\x22\57\155\157\x64\x75\154\157\163\57\143\145\162\162\141\x72\56\x70\x68\x70\x22\40\x63\x6c\141\163\x73\75\x22\151\143\x6f\x6e\40\x73\x6f\x6c\x69\x64\40\x66\141\55\x73\x69\147\x6e\x2d\157\165\164\55\141\154\x74\x22\x3e\x20\103\x65\x72\x72\x61\162\x20\163\145\163\x69\x6f\156\x3c\x2f\x61\x3e";
            goto dPHNo;
            AFtqN:
            UBai1:
            goto gVTLn;
            A9bKP:
        }
    }
