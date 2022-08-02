<?php
require_once __DIR__.'/bootstrap.php';
?>

<?php include 'views/header.php'; ?>
    <div id="app" v-cloak>
        <div class="container">
            <h6><a href="<?= CONFIG['site_url'] ?>">Liste des documents</a></h6>
            <form>
                <div class="form-group mb-3">
                    <label>Title: </label>
                    <input class="form-control" type="text" name="title" required v-model="form.title" />
                </div>

                <div class="form-group mb-3">
                    <label>Message</label>
                    <textarea class="form-control" name="message" id="content" cols="30" rows="10" required v-model="form.message"></textarea>
                </div>
                <br>
                {{form}}
                <button 
                    class="btn btn-secondary text-light"
                    @click.prevent="storeDoc" 
                >Store</button>
            </form>            
        </div>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        const { createApp, ref } = Vue

        const app = createApp({
            setup() {
                const form = ref({title: '', message: ''});

                async function storeDoc() {
                    const payload = { title: form.value.title, message: form.value.message };
                    const res = await axios.post(siteURL + 'api/upload.php', payload);
                    alert('Thank you');
                }                

                return { siteURL, storeDoc, form }
            }            
        });

        app.mount('#app');
    </script>
<?php include 'views/footer.php'; ?>