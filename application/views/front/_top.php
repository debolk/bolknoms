<div class="block">
  <h2>Top eters <abbr title="Year-to-date">YTD</abbr></h2>
  <ol>
    <li>Peter Moolenaar (<?php $p = $top_eaters_ytd->current(); echo $p['count']+1;?>)</li>
    <?php foreach($top_eaters_ytd as $registration): ?>
      <li><?php echo $registration->name; ?> (<?php echo $registration->count;?>)</li>
    <?php endforeach; ?>
  </ol>
</div>

<div class="block">
  <h2>Top eters all-time</h2>
  <ol class="top_registrations">
    <?php foreach($top_eaters_alltime as $registration): ?>
      <li><?php echo $registration->name; ?> (<?php echo $registration->count;?>)</li>
    <?php endforeach; ?>
  </ol>
</div>