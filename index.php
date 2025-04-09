<?php
require 'auth.php';
$pageTitle = "لوحة التحكم";
require 'config.php';

$stmt = $pdo->query("SELECT candidate_id, SUM(vote_count) AS total_votes FROM votes GROUP BY candidate_id");
$votes = $stmt->fetchAll();

$candidates = [];
if ($votes) {
    $ids = array_column($votes, 'candidate_id');
        $in = implode(',', array_fill(0, count($ids), '?'));
            $stmt2 = $pdo->prepare("SELECT * FROM candidates WHERE id IN ($in)");
                $stmt2->execute($ids);
                    while ($row = $stmt2->fetch()) {
                            $candidates[$row['id']] = $row;
                                }
                                }
                                include 'header.php';
                                ?>
                                <section class="hero mb-4">
                                  <div class="container">
                                      <h1>مرحباً بكم في نظام الانتخابات</h1>
                                          <p>نظام متكامل لإدارة المراكز والمحطات مع تتبع الأصوات بسهولة.</p>
                                              <a href="add_votes.php" class="btn btn-light btn-custom">إدخال الأصوات</a>
                                                </div>
                                                </section>
                                                <section class="py-3">
                                                  <h2 class="text-center mb-3">إجمالي الأصوات للمرشحين</h2>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
                                                              <thead class="table-primary">
                                                                      <tr>
                                                                                <th>اسم المرشح</th>
                                                                                          <th>إجمالي الأصوات</th>
                                                                                                  </tr>
                                                                                                        </thead>
                                                                                                              <tbody>
                                                                                                                      <?php if(!empty($votes)): ?>
                                                                                                                                <?php foreach($votes as $vote): ?>
                                                                                                                                            <tr>
                                                                                                                                                          <td><?php echo htmlspecialchars($candidates[$vote['candidate_id']]['candidate_name']); ?></td>
                                                                                                                                                                        <td><?php echo $vote['total_votes']; ?></td>
                                                                                                                                                                                    </tr>
                                                                                                                                                                                              <?php endforeach; ?>
                                                                                                                                                                                                      <?php else: ?>
                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                            <td colspan="2" class="text-center">لا توجد أصوات مسجلة حتى الآن.</td>
                                                                                                                                                                                                                                      </tr>
                                                                                                                                                                                                                                              <?php endif; ?>
                                                                                                                                                                                                                                                    </tbody>
                                                                                                                                                                                                                                                        </table>
                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                          </section>
                                                                                                                                                                                                                                                          <?php include 'footer.php'; ?>