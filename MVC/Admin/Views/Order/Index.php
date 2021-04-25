<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger mt-2">Orders</h3>
            </div>
        </div>
        <div class="row contact-table mb-4">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="orderTable" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created Day</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model['listOrder'] as $item): ?>
                            <tr>
                                <td><?php echo $item['ID']; ?></td>
                                <td><?php echo $item['CustomerName']; ?></td>
                                <td><?php echo $item['CreatedDay']; ?></td>
                                <td>
                                <?php if ($item['Status']): ?>
                                    <label class="text-success font-weight-bold">Accepted</label>
                                <?php else: ?>
                                    <label class="text-danger font-weight-bold">Processing</label>
                                <?php endif; ?>
                                </td>
                                <td>
                                    <button onclick="loadOrder(<?php echo $item['ID']; ?>)" class="btn btn-secondary mb-2" title="View"><i class="fas fa-eye"></i></button>
                                    <?php if ($item['Status']): ?>
                                        <button title="Processing" class="btn btn-warning mb-2"><i class="fas fa-history"></i></button>
                                    <?php else: ?>
                                        <button title="Accepted" class="btn btn-success mb-2"><i class="fas fa-check-double"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 table-message" id="orderInfo">
                  
            </div>
        </div>
    </div>

    <!-- toast -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="position: fixed; top: 2.5rem; right: 1rem; width: 17%;">
        <div class="toast-header">
            <strong id="titleToast" class="mr-auto"></strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div style="display:flex;justify-content:space-between;align-item:center;" class="toast-body">
            <div id="iconToast">
              
            </div>
            <div id="contentToast">
                        
            </div>
        </div>
    </div>
    <!-- end toast -->