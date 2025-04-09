<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
        exit;
        }
        $pageTitle = "أدوات الإدارة";
        require 'config.php';
        include 'header.php';
        ?>
        <div class="card shadow-sm mb-4">
          <div class="card-body text-center">
              <h2 class="card-title mb-3">
                    <i class="fa-solid fa-cogs"></i> أدوات الإدارة
                        </h2>
                            <div class="d-grid gap-2">
                                  <a href="manage_centers.php" class="btn btn-danger btn-custom" title="إدارة المراكز">
                                          <i class="fa-solid fa-city"></i> إدارة المراكز
                                                </a>
                                                      <a href="manage_candidates.php" class="btn btn-warning btn-custom" title="إدارة المرشحين">
                                                              <i class="fa-solid fa-user-tie"></i> إدارة المرشحين
                                                                    </a>
                                                                          <a href="manage_accounts.php" class="btn btn-secondary btn-custom" title="إدارة الحسابات">
                                                                                  <i class="fa-solid fa-user-cog"></i> إدارة الحسابات
                                                                                        </a>
                                                                                              <a href="add_user.php" class="btn btn-success btn-custom" title="إضافة مستخدم جديد">
                                                                                                      <i class="fa-solid fa-user-plus"></i> إضافة مستخدم جديد
                                                                                                            </a>
                                                                                                                  <a href="upload_csv.php" class="btn btn-info btn-custom" title="رفع CSV">
                                                                                                                          <i class="fa-solid fa-file-upload"></i> رفع CSV
                                                                                                                                </a>
                                                                                                                                      <a href="add_center.php" class="btn btn-warning btn-custom" title="إضافة مركز">
                                                                                                                                              <i class="fa-solid fa-building-circle-plus"></i> إضافة مركز
                                                                                                                                                    </a>
                                                                                                                                                          <a href="add_candidate.php" class="btn btn-success btn-custom" title="إضافة مرشح">
                                                                                                                                                                  <i class="fa-solid fa-user-check"></i> إضافة مرشح
                                                                                                                                                                        </a>
                                                                                                                                                                              <a href="log.php" class="btn btn-info btn-custom" title="عرض السجل">
                                                                                                                                                                                      <i class="fa-solid fa-history"></i> عرض السجل
                                                                                                                                                                                            </a>
                                                                                                                                                                                                  <!-- زر عرض الأصوات المضاف -->
                                                                                                                                                                                                        <a href="view_votes.php" class="btn btn-primary btn-custom" title="عرض الأصوات">
                                                                                                                                                                                                                <i class="fa-solid fa-chart-bar"></i> عرض الأصوات
                                                                                                                                                                                                                      </a>
                                                                                                                                                                                                                            <a href="admin_logout.php" class="btn btn-outline-danger btn-custom" title="تسجيل الخروج">
                                                                                                                                                                                                                                    <i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج
                                                                                                                                                                                                                                          </a>
                                                                                                                                                                                                                                              </div>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                <div class="text-center">
                                                                                                                                                                                                                                                  <a href="index.php" class="btn btn-primary btn-custom" title="العودة إلى الصفحة الرئيسية">
                                                                                                                                                                                                                                                      <i class="fa-solid fa-house-chimney"></i> الرئيسية
                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                        <?php include 'footer.php'; ?>