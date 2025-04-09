<?php
session_start();
$pageTitle = "تسجيل دخول الأدمن";
$error = "";

if (isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_tools.php");
        exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST["username"]);
                $password = trim($_POST["password"]);
                    $adminUser = "admin";
                        $adminPass = "admin123";

                            if ($username === $adminUser && $password === $adminPass) {
                                    $_SESSION["admin_logged_in"] = true;
                                            header("Location: admin_tools.php");
                                                    exit;
                                                        } else {
                                                                $error = "بيانات اعتماد الأدمن غير صحيحة.";
                                                                    }
                                                                    }
                                                                    include 'header.php';
                                                                    ?>
                                                                    <div class="card shadow-sm">
                                                                      <div class="card-body">
                                                                          <h2 class="card-title text-center mb-3">تسجيل دخول الأدمن</h2>
                                                                              <?php if ($error): ?>
                                                                                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                                                                                        <?php endif; ?>
                                                                                            <form method="POST">
                                                                                                  <div class="mb-3">
                                                                                                          <label class="form-label">اسم المستخدم</label>
                                                                                                                  <input type="text" name="username" class="form-control" placeholder="ادخل اسم المستخدم" required>
                                                                                                                        </div>
                                                                                                                              <div class="mb-3">
                                                                                                                                      <label class="form-label">كلمة المرور</label>
                                                                                                                                              <input type="password" name="password" class="form-control" placeholder="ادخل كلمة المرور" required>
                                                                                                                                                    </div>
                                                                                                                                                          <div class="d-grid gap-2">
                                                                                                                                                                  <button type="submit" class="btn btn-primary btn-custom">تسجيل الدخول</button>
                                                                                                                                                                        </div>
                                                                                                                                                                            </form>
                                                                                                                                                                              </div>
                                                                                                                                                                              </div>
                                                                                                                                                                              <?php include 'footer.php'; ?>