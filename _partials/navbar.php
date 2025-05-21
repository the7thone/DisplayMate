<?php
$navItems = [
  ['href' => 'index.php', 'label' => 'Home', 'active' => true],
  [
    'href' => '#',
    'label' => 'User',
    'dropdown' => true,
    'items' => [
      ['href' => 'register.php', 'label' => 'Register'],
      ['href' => 'login.php', 'label' => 'Login']
    ]
  ],
  [
    'href' => '#',
    'label' => 'Services',
    'dropdown' => true,
    'items' => [
      ['href' => 'holidays.php', 'label' => 'Holidays'],
      ['href' => 'news.php', 'label' => 'News']
    ]
  ],
  ['href' => 'about.php', 'label' => 'About Us', 'active' => false]
];
?>

<div class="card m-3 shadow">
  <div class="card-body">
    <nav class="navbar navbar-expand-lg rounded">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">DisplayMate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php foreach ($navItems as $item): ?>
              <?php if (isset($item['dropdown']) && $item['dropdown']): ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="<?= $item['href'] ?>" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?= $item['label'] ?>
                  </a>
                  <ul class="dropdown-menu">
                    <?php foreach ($item['items'] as $dropdownItem): ?>
                      <li><a class="dropdown-item" href="<?= $dropdownItem['href'] ?>"><?= $dropdownItem['label'] ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </li>
              <?php else: ?>
                <li class="nav-item <?= isset($item['active']) && $item['active'] ? 'active' : '' ?>">
                  <a class="nav-link <?= isset($item['disabled']) && $item['disabled'] ? 'disabled' : '' ?>"
                    href="<?= isset($item['disabled']) && $item['disabled'] ? '#' : $item['href'] ?>"
                    <?= isset($item['disabled']) && $item['disabled'] ? 'aria-disabled="true"' : '' ?>>
                    <?= $item['label'] ?>
                  </a>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
          <!-- 
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
         -->
        </div>
      </div>
    </nav>
  </div>
</div>