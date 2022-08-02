<?php
require_once __DIR__.'/bootstrap.php';
?>

<?php include 'views/header.php'; ?>
    <div id="app" v-cloak>
        <div class="container p-2">
            <h6><a href="<?= CONFIG['site_url'].'/upload.php' ?>">Ajouter un document</a></h6>
            <div class="btn-group" role="group" aria-label="Commands">
                <button type="button" class="btn btn-sm btn-secondary" @click="showAllDocs">Show all</button>
                <button type="button" class="btn btn-sm btn-secondary" @click="hideAllDocs">Hide all</button>
            </div>
            <table class="table">  
                <tr>
                    <th>Title</th>
                    <th>Message</th>
                </tr>
                <tr v-for="doc in docs" :key="doc.id">
                    <td>
                        <span>{{ doc.title }}</span>
                        <button 
                            class="btn btn-sm btn-outline-primary ms-2"
                            @click="doc.isVisible = !doc.isVisible"
                        >{{ doc.isVisible ? 'Hide' : 'Show' }}</button>                        
                    </td>
                    <td>                        
                        <textarea v-show="doc.isVisible" class="form-control" cols="30" rows="5" :value="doc.message" readonly></textarea>
                    </td>
                </tr>
            </table>
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
                    resp = await axios.get(siteURL + 'api/list.php');
                    console.log(docs.value);
                    docs.value = resp.data.response;
                }

                function showAllDocs() {
                    docs.value.forEach(doc => doc.isVisible = true);
                }
                function hideAllDocs() {
                    docs.value.forEach(doc => doc.isVisible = false);
                }

                fetchDocs();

                return { docs, siteURL, showAllDocs, hideAllDocs }
            }            
        });

        app.mount('#app');
    </script>
<?php include 'views/footer.php'; ?>