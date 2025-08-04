<?php
$page_title = "Search Results";
include 'includes/config.php';
include 'includes/header.php';

$query = isset($_GET['query']) ? sanitizeInput($_GET['query']) : '';
$category = isset($_GET['category']) ? sanitizeInput($_GET['category']) : '';
?>

<div class="page-header">
    <div class="container">
        <h1>Search Results</h1>
        <?php if($query): ?>
            <p>Showing results for: "<strong><?php echo htmlspecialchars($query); ?></strong>"</p>
        <?php endif; ?>
    </div>
</div>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="content-section">
                    <?php if($query): ?>
                        <div class="search-results">
                            <h3>Found 156 results</h3>
                            
                            <div class="result-item">
                                <h4><a href="job-detail.php?id=1">BSF Constable Online Form (3588 Posts)</a></h4>
                                <p>Border Security Force recruitment for Constable Tradesman posts. Apply online for various trade positions...</p>
                                <div class="result-meta">
                                    <span class="category">Latest Jobs</span>
                                    <span class="date">04/08/2025</span>
                                </div>
                            </div>
                            
                            <div class="result-item">
                                <h4><a href="result-detail.php?id=1">Railway SECR Apprentice Result 2025</a></h4>
                                <p>South East Central Railway has announced final merit list for Apprentice recruitment...</p>
                                <div class="result-meta">
                                    <span class="category">Results</span>
                                    <span class="date">04/08/2025</span>
                                </div>
                            </div>
                            
                            <div class="result-item">
                                <h4><a href="admit-detail.php?id=1">SSC Stenographer Admit Card 2025</a></h4>
                                <p>Staff Selection Commission has released admit card for Stenographer Grade C & D examination...</p>
                                <div class="result-meta">
                                    <span class="category">Admit Card</span>
                                    <span class="date">03/08/2025</span>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="no-results">
                            <i class="fas fa-search" style="font-size: 48px; color: #bdc3c7; margin-bottom: 20px;"></i>
                            <h3>Enter search term</h3>
                            <p>Please enter a search term to find relevant content.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="sidebar">
                    <h3>Refine Search</h3>
                    <form action="search.php" method="GET">
                        <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                <option value="jobs" <?php echo $category == 'jobs' ? 'selected' : ''; ?>>Jobs</option>
                                <option value="results" <?php echo $category == 'results' ? 'selected' : ''; ?>>Results</option>
                                <option value="admit-card" <?php echo $category == 'admit-card' ? 'selected' : ''; ?>>Admit Card</option>
                                <option value="answer-key" <?php echo $category == 'answer-key' ? 'selected' : ''; ?>>Answer Key</option>
                            </select>
                        </div>
                        <button type="submit" class="btn">Filter Results</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.search-results h3 {
    color: #2c3e50;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #3498db;
}

.result-item {
    padding: 20px;
    margin-bottom: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border-left: 4px solid #3498db;
}

.result-item h4 {
    margin: 0 0 10px 0;
}

.result-item h4 a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 600;
}

.result-item h4 a:hover {
    color: #3498db;
}

.result-item p {
    color: #555;
    margin-bottom: 15px;
    line-height: 1.6;
}

.result-meta {
    display: flex;
    gap: 15px;
    font-size: 14px;
}

.result-meta .category {
    background: #3498db;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.result-meta .date {
    color: #7f8c8d;
}

.no-results {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 10px;
}

.no-results h3 {
    color: #2c3e50;
    margin-bottom: 10px;
}

.no-results p {
    color: #7f8c8d;
}
</style>

<?php include 'includes/footer.php'; ?>
