<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doc share</title>	
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>            
        [v-cloak] { display: none; }
        .slide-fade-enter-active {
            transition: all 0.7s ease-out;
        }

        .slide-fade-leave-active {
            transition: all 0.2s cubic-bezier(0,1.01,.8,.78);
        }

        .slide-fade-enter-from,
        .slide-fade-leave-to {
            transform: translateX(5px);
            opacity: 0;
        }

        /* Modal */
        .app-modal {
            position: fixed;
            width: 100%;            
            top: 0; left: 0; right: 0; bottom: 0;            
            background-color: transparent;
            z-index: 999999;            
        }
        .app-modal__overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.64);
            width: 100%; height: 100%;
            z-index: 999998;
        }
        .app-modal__wrapper {
            position: relative;
        }
        .app-modal-body {
            position: fixed;
            top: 40%; left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
            transition: background-color .7s;            
            z-index: 999999;
        }
    </style>
    <script>
        siteURL = '<?= CONFIG['site_url'] ?>';
    </script>
</head>
<body>    