<div class="job-table-list">
    <table id="career"  class="table-sort table-sort-search" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Job Title</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($col as $key => $post_id): ?>
                <tr>
                    <td><?php echo $post_id; ?></td>
                    <td><a href="<?php echo $this->get_job_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></td>
                    <td><?php echo get_post_meta($post_id, 'cr_location', true); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">


    jQuery(document).ready(function ($) {
        $('#career').DataTable({
            "order": [[2, "desc"]]
        });

//         $('table.table-sort').tablesort();
        //hljs.initHighlightingOnLoad(); // Syntax Hilighting


    });
</script>