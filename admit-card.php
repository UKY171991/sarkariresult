<?php
$page_title = "Admit Card";
$breadcrumb = ['Admit Card' => null];
include 'includes/config.php';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <h1>Admit Card Download 2025</h1>
        <p>Download latest government exam admit cards, hall tickets, and exam dates</p>
    </div>
</div>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="content-section">
                    <h2 class="section-title">Latest Admit Cards</h2>
                    
                    <div class="admit-list">
                        <div class="admit-item featured">
                            <div class="admit-header">
                                <h3><a href="admit-detail.php?id=1">SSC Stenographer C, D Admit Card 2025 – Out</a></h3>
                                <span class="badge admit">Admit Card</span>
                            </div>
                            <div class="admit-details">
                                <div class="admit-meta">
                                    <span><i class="fas fa-calendar"></i> Exam Date: 15/08/2025 to 20/08/2025</span>
                                    <span><i class="fas fa-download"></i> Available: Now</span>
                                    <span><i class="fas fa-building"></i> Organization: SSC</span>
                                </div>
                                <p class="admit-description">Staff Selection Commission has released admit card for Stenographer Grade C & D posts. Candidates can download from official website.</p>
                                <div class="admit-actions">
                                    <a href="admit-detail.php?id=1" class="btn">View Details</a>
                                    <a href="#" class="btn btn-success">Download</a>
                                </div>
                            </div>
                        </div>

                        <div class="admit-item">
                            <div class="admit-header">
                                <h3><a href="admit-detail.php?id=2">Railway RRB NTPC 10+2 Inter Level Admit Card 2025 – Out</a></h3>
                                <span class="badge admit">Admit Card</span>
                            </div>
                            <div class="admit-details">
                                <div class="admit-meta">
                                    <span><i class="fas fa-calendar"></i> Exam Date: 22/08/2025 to 30/08/2025</span>
                                    <span><i class="fas fa-download"></i> Available: Now</span>
                                    <span><i class="fas fa-building"></i> Organization: RRB</span>
                                </div>
                                <p class="admit-description">Railway Recruitment Board has issued admit card for NTPC 10+2 Inter Level positions. Download using registration number and date of birth.</p>
                                <div class="admit-actions">
                                    <a href="admit-detail.php?id=2" class="btn">View Details</a>
                                    <a href="#" class="btn btn-success">Download</a>
                                </div>
                            </div>
                        </div>

                        <div class="admit-item">
                            <div class="admit-header">
                                <h3><a href="admit-detail.php?id=3">Bihar Vidhan Parishad Office Attendant 03/2024 Admit Card Date 2025</a></h3>
                                <span class="badge upcoming">Coming Soon</span>
                            </div>
                            <div class="admit-details">
                                <div class="admit-meta">
                                    <span><i class="fas fa-calendar"></i> Expected Date: 12/08/2025</span>
                                    <span><i class="fas fa-clock"></i> Status: Date Announced</span>
                                    <span><i class="fas fa-building"></i> Organization: Bihar Vidhan Parishad</span>
                                </div>
                                <p class="admit-description">Bihar Legislative Council has announced admit card release date for Office Attendant posts (Advertisement 03/2024). Expected to release soon.</p>
                                <div class="admit-actions">
                                    <a href="admit-detail.php?id=3" class="btn">View Details</a>
                                    <a href="#" class="btn btn-secondary">Set Reminder</a>
                                </div>
                            </div>
                        </div>

                        <div class="admit-item">
                            <div class="admit-header">
                                <h3><a href="admit-detail.php?id=4">DSSSB Assistant Teacher 08/2023 Admit Card 2025 – Out</a></h3>
                                <span class="badge admit">Admit Card</span>
                            </div>
                            <div class="admit-details">
                                <div class="admit-meta">
                                    <span><i class="fas fa-calendar"></i> Exam Date: 18/08/2025</span>
                                    <span><i class="fas fa-download"></i> Available: Now</span>
                                    <span><i class="fas fa-building"></i> Organization: DSSSB</span>
                                </div>
                                <p class="admit-description">Delhi Subordinate Services Selection Board has released admit card for Assistant Teacher posts under advertisement 08/2023.</p>
                                <div class="admit-actions">
                                    <a href="admit-detail.php?id=4" class="btn">View Details</a>
                                    <a href="#" class="btn btn-success">Download</a>
                                </div>
                            </div>
                        </div>

                        <div class="admit-item">
                            <div class="admit-header">
                                <h3><a href="admit-detail.php?id=5">BPSSC Range Officer of Forest Admit Card Date 2025 – Out</a></h3>
                                <span class="badge upcoming">Date Announced</span>
                            </div>
                            <div class="admit-details">
                                <div class="admit-meta">
                                    <span><i class="fas fa-calendar"></i> Expected Date: 10/08/2025</span>
                                    <span><i class="fas fa-clock"></i> Status: Date Released</span>
                                    <span><i class="fas fa-building"></i> Organization: BPSSC</span>
                                </div>
                                <p class="admit-description">Bihar Public Service Selection Commission has announced the admit card release date for Range Officer of Forest posts.</p>
                                <div class="admit-actions">
                                    <a href="admit-detail.php?id=5" class="btn">View Details</a>
                                    <a href="#" class="btn btn-secondary">Set Reminder</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pagination">
                        <a href="#" class="page-link active">1</a>
                        <a href="#" class="page-link">2</a>
                        <a href="#" class="page-link">3</a>
                        <a href="#" class="page-link">4</a>
                        <a href="#" class="page-link">5</a>
                        <a href="#" class="page-link">Next</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sidebar">
                    <h3>Download Admit Card</h3>
                    <form action="download-admit-card.php" method="POST" class="admit-download-form">
                        <div class="form-group">
                            <label>Select Exam</label>
                            <select name="exam" class="form-control" required>
                                <option value="">Choose Exam</option>
                                <option value="ssc-stenographer">SSC Stenographer</option>
                                <option value="railway-ntpc">Railway NTPC</option>
                                <option value="ibps-clerk">IBPS Clerk</option>
                                <option value="sbi-po">SBI PO</option>
                                <option value="upsc-cse">UPSC CSE</option>
                                <option value="bpsc-67th">BPSC 67th CCE</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Registration Number</label>
                            <input type="text" name="registration" class="form-control" placeholder="Enter registration number" required>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Captcha</label>
                            <div class="captcha-container">
                                <img src="captcha.php" alt="Captcha" class="captcha-image">
                                <button type="button" class="refresh-captcha">🔄</button>
                            </div>
                            <input type="text" name="captcha" class="form-control" placeholder="Enter captcha" required>
                        </div>
                        <button type="submit" class="btn btn-success">Download Admit Card</button>
                    </form>
                </div>

                <div class="sidebar">
                    <h3>Exam Categories</h3>
                    <ul class="category-list">
                        <li><a href="?category=ssc">SSC Exams</a> <span class="count">(23)</span></li>
                        <li><a href="?category=railway">Railway Exams</a> <span class="count">(18)</span></li>
                        <li><a href="?category=banking">Banking Exams</a> <span class="count">(15)</span></li>
                        <li><a href="?category=upsc">UPSC Exams</a> <span class="count">(8)</span></li>
                        <li><a href="?category=state">State PSC</a> <span class="count">(45)</span></li>
                        <li><a href="?category=defense">Defense Exams</a> <span class="count">(12)</span></li>
                        <li><a href="?category=teaching">Teaching Exams</a> <span class="count">(34)</span></li>
                        <li><a href="?category=entrance">Entrance Exams</a> <span class="count">(27)</span></li>
                    </ul>
                </div>

                <div class="sidebar">
                    <h3>Important Instructions</h3>
                    <div class="instruction-list">
                        <div class="instruction-item">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <h4>Download in Time</h4>
                                <p>Download your admit card before the deadline. Late downloads may not be allowed.</p>
                            </div>
                        </div>
                        <div class="instruction-item">
                            <i class="fas fa-id-card"></i>
                            <div>
                                <h4>Valid ID Required</h4>
                                <p>Carry original photo ID proof along with admit card to the examination center.</p>
                            </div>
                        </div>
                        <div class="instruction-item">
                            <i class="fas fa-print"></i>
                            <div>
                                <h4>Print Quality</h4>
                                <p>Take clear printout of admit card. Blurred or damaged cards may be rejected.</p>
                            </div>
                        </div>
                        <div class="instruction-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Reach Early</h4>
                                <p>Reach examination center at least 30 minutes before exam time.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar">
                    <h3>Upcoming Exam Dates</h3>
                    <div class="exam-calendar">
                        <div class="exam-date-item">
                            <div class="date-box">
                                <div class="day">15</div>
                                <div class="month">AUG</div>
                            </div>
                            <div class="exam-info">
                                <h4>SSC Stenographer</h4>
                                <p>Grade C & D Exam</p>
                            </div>
                        </div>
                        <div class="exam-date-item">
                            <div class="date-box">
                                <div class="day">22</div>
                                <div class="month">AUG</div>
                            </div>
                            <div class="exam-info">
                                <h4>Railway NTPC</h4>
                                <p>CBT 1 Exam</p>
                            </div>
                        </div>
                        <div class="exam-date-item">
                            <div class="date-box">
                                <div class="day">28</div>
                                <div class="month">AUG</div>
                            </div>
                            <div class="exam-info">
                                <h4>IBPS Clerk</h4>
                                <p>Preliminary Exam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admit-list {
    margin-bottom: 30px;
}

.admit-item {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border-left: 4px solid #9b59b6;
    transition: all 0.3s ease;
}

.admit-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.admit-item.featured {
    border-left-color: #e74c3c;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
}

.admit-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.admit-header h3 {
    margin: 0;
    flex: 1;
}

.admit-header h3 a {
    color: #2c3e50;
    text-decoration: none;
    font-size: 20px;
    font-weight: 600;
}

.admit-header h3 a:hover {
    color: #9b59b6;
}

.badge.upcoming {
    background: #f39c12;
    color: white;
}

.admit-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #7f8c8d;
}

.admit-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.admit-description {
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.admit-actions {
    display: flex;
    gap: 10px;
}

.admit-download-form .form-group {
    margin-bottom: 15px;
}

.admit-download-form label {
    font-size: 14px;
    margin-bottom: 5px;
}

.captcha-container {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.captcha-image {
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.refresh-captcha {
    background: #3498db;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
}

.instruction-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.instruction-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.instruction-item i {
    color: #e74c3c;
    font-size: 18px;
    margin-top: 2px;
}

.instruction-item h4 {
    margin: 0 0 5px 0;
    font-size: 14px;
    color: #2c3e50;
}

.instruction-item p {
    margin: 0;
    font-size: 13px;
    color: #7f8c8d;
    line-height: 1.4;
}

.exam-calendar {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.exam-date-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid #3498db;
}

.date-box {
    text-align: center;
    background: #3498db;
    color: white;
    padding: 8px;
    border-radius: 6px;
    min-width: 50px;
}

.date-box .day {
    font-size: 20px;
    font-weight: 700;
    line-height: 1;
}

.date-box .month {
    font-size: 12px;
    font-weight: 600;
}

.exam-info h4 {
    margin: 0 0 5px 0;
    font-size: 16px;
    color: #2c3e50;
}

.exam-info p {
    margin: 0;
    font-size: 13px;
    color: #7f8c8d;
}

@media (max-width: 768px) {
    .admit-header {
        flex-direction: column;
        gap: 10px;
    }
    
    .admit-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .admit-actions {
        flex-direction: column;
    }
    
    .captcha-container {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .exam-date-item {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
