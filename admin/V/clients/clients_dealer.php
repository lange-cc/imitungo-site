<input value= "dealer" type="hidden" id="page-type">

<div class="content-wrapper">
<div class="client-widget">
    <div class="inventory-ribbon">
          <div class="inventory-section-title">
                <span class="mdi mdi-account"></span> Clients Dealer
          </div>
        <div class="tool-bar">
        
        </div>
    </div>
  


        <div class="data-list">
            <table class="table table-striped">
                <tr>
                    <th>N<sup>o</sup></th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(dealer,index) in dealers">
                    <td v-html="index+1"></td>
                    <td v-html="dealer.name "></td>
                    <td v-html="dealer.phone"></td>
                    <td v-html="dealer.email"></td>
                    <td>
                        <a :href="'<?=LINK?>clients/view-dealer-client/'+dealer.id"  title="View Information" class="btn btn-outline-primary"><span class="mdi mdi-eye-outline"></span></a>

                        <a class="btn btn-outline-danger   if-phone-btn" title="Move to Trash" @click="DeleteClient(dealer.id,index)"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            </table>

            <div class="pagination-widget">
                <ul class="pagination">
                    <li class="page-item" v-if="prev_page != null"  @click="GetAll(prev_page)"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item" v-for="page in end_page" v-if="page != 0"  :class=" 'page_'+page " @click="GetAll(page)"><a class="page-link" href="#" v-html="page"></a></li>
                    <li class="page-item" v-if="next_page != null" @click="GetAll(next_page)"> <a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </div>



</div>
</div>