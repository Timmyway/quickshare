<?php
try {
    require 'config.php';
    include_once(ROOT.'connection.php');
    
    /* Create a prepared statement */
    $stmt = $db -> prepare("CREATE TABLE IF NOT EXISTS doc (id INTEGER PRIMARY KEY, title VARCHAR(50), message TEXT);");
    
    /* execute the query */
    $stmt -> execute();    
    
    /* close connection */
    $db = null;
} catch (PDOExecption $e){
    echo $e->getMessage();
}
?>

<?php include 'views/header.php'; ?>
    <div id="app" v-cloak>
        <div class="container">
        <ul class="list-group" v-for="doc in docs" :key="doc.id">  
            <li class="list-group-item">{{ doc.title }}</li>
        </ul>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        const { createApp, ref } = Vue

        const app = createApp({
            setup() {
                const docs = ref([]);

                async function fetchDocs() {
                    docs.value = await axios.get(siteURL + 'api/list.php');
                    console.log(docs.value);
                }

                fetchDocs();

                return { docs, siteURL }
            }            
        });

        app.mount('#app');
    </script>
<?php include 'views/footer.php'; ?>