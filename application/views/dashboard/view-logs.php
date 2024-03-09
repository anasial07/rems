<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col">
                <div class="page-header mt-3">
                    <div class="page-title">
                        <h4>Activity Logs</h4>
                        <h6>Unveiling the Digital Footprints</h6>
                    </div>
                </div>
            </div>
            <div class="col text-end pt-3">
                <img width="50" src="<?= base_url('assets/img/loading.webp'); ?>">
            </div>
        </div>
        <div class="activity">
            <div class="activity-box">
                <?php if(count($allLogs)>0){ ?>
                <ul class="activity-list">
                    <?php foreach($allLogs as $logs): ?>
                        <li>
                            <div class="activity-user">
                                <a><img src="<?= base_url('assets/img/favicon.png'); ?>" class="img-fluid"></a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <a class="name"><?= $logs->empName; ?> </a> has made some changes in <a><?= ucwords($logs->logCategory); ?></a> <span class="text-primary view-log" style="cursor:pointer; font-size:12px;">[view log]</span>
                                    <span class="time"><?= date('d M, Y g:i:s A - l', strtotime($logs->logCreatedAt)); ?></span>
                                </div>
                                <div class="mt-3 log-data" style="display:none;">
                                    <?php
                                    $logsData = $logs->logData;
                                    $logArray = json_decode($logsData, true);
                                    if(is_array($logArray) && !empty($logArray)){
                                        foreach($logArray as $key => $value){
                                        ?>
                                            <div class="row">
                                                <div class="col-2"><?= $key; ?></div>
                                                <div class="col"><?= $value; ?></div>
                                            </div>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php }else{ ?>
                    <center style="margin-top:10%;"><img src="<?= base_url('assets/img/no-record-found.png'); ?>"></center>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.view-log').on('click', function(){
            $('.log-data').not($(this).closest('li').find('.log-data')).slideUp();
            var logDataDiv = $(this).closest('li').find('.log-data');
            logDataDiv.slideToggle();
        });
    });
</script>