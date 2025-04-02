<!-- Sidebar -->
<div class="sidebar-wrapper">
    <div class="sidebar">
        <div class="text-center mb-4">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                     alt="Profile" 
                     class="profile-image">
            @else
                <i class="fas fa-user-circle profile-icon"></i>
            @endif
            <h5 class="user-name">{{ auth()->user()->name }}</h5>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }}" href="{{ route('profileuser.show') }}">
                    <i class="fas fa-user-circle"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('appointments*') ? 'active' : '' }}" href="{{ route('available.appointments') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('records*') ? 'active' : '' }}" href="#">
                    <i class="fas fa-file-medical"></i>
                    <span>Medical Records</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                    @php
                        $unreadCount = DB::table('notifications')
                            ->where('receiver', auth()->id())
                            ->where('status', 'pending')
                            ->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="notification-badge">{{ $unreadCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu notifications-menu" aria-labelledby="notificationsDropdown">
                    <div class="notifications-header d-flex justify-content-between align-items-center p-3">
                        <h6 class="mb-0">Notifications</h6>
                    </div>
                    <div class="notifications-list">
                        @php
                            $notifications = DB::table('notifications')
                                ->where('receiver', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();
                        @endphp
                        @forelse($notifications as $notification)
                            <div class="notification-item {{ $notification->status == 'pending' ? 'unread' : '' }}" 
                                 data-id="{{ $notification->id }}">
                                <p class="mb-1">{{ $notification->message }}</p>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                            </div>
                        @empty
                            <div class="text-center p-3">
                                <p class="mb-0">No notifications</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<style>
.sidebar-wrapper {
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
    width: 250px;
    background: #f8f9fa;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    z-index: 1000;
}

.sidebar {
    padding: 2rem 1rem;
    height: 100%;
    overflow-y: auto;
}

.profile-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #3fbbc0;
    padding: 3px;
    transition: transform 0.3s ease;
}

.profile-image:hover {
    transform: scale(1.05);
}

.profile-icon {
    font-size: 100px;
    color: #3fbbc0;
}

.user-name {
    margin-top: 1rem;
    color: #333;
    font-weight: 600;
}

.nav-menu {
    list-style: none;
    padding: 0;
    margin-top: 2rem;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.8rem 1rem;
    color: #555;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.nav-link i {
    font-size: 1.2rem;
    margin-right: 1rem;
    width: 24px;
    text-align: center;
}

.nav-link span {
    font-weight: 500;
}

.nav-link:hover {
    background: #e9ecef;
    color: #3fbbc0;
    transform: translateX(5px);
}

.nav-link.active {
    background: #3fbbc0;
    color: white;
}

.nav-link.active i {
    color: white;
}

/* تعديل المحتوى الرئيسي */
.content-wrapper {
    margin-left: 250px;
    padding: 2rem;
}

@media (max-width: 768px) {
    .sidebar-wrapper {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .sidebar-wrapper.show {
        transform: translateX(0);
    }

    .content-wrapper {
        margin-left: 0;
    }
}

.notification-badge {
    position: absolute;
    top: 0;
    right: 5px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.7rem;
    min-width: 18px;
    text-align: center;
}

.notifications-menu {
    width: 300px;
    padding: 0;
    margin: 0;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0,0,0,0.15);
    position: fixed !important;
    left: 50% !important;
    top: 50% !important;
    transform: translate(-50%, -50%) !important;
    z-index: 1055;
}

/* إضافة خلفية معتمة عند فتح النافذة */
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1054;
    display: none;
}

.sidebar-wrapper {
    z-index: 1052;
}

.modal {
    z-index: 1056;
}

.modal-dialog {
    z-index: 1057;
}

.show + .modal-backdrop {
    display: block;
}

.notifications-list {
    max-height: 300px;
    overflow-y: auto;
}

.notification-item {
    padding: 10px 15px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.notification-item:hover {
    background-color: #f8f9fa;
}

.notification-item.unread {
    background-color: #f0f9ff;
}

.notification-item:last-child {
    border-bottom: none;
}

.notifications-header {
    border-bottom: 1px solid #eee;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggle = document.getElementById('notificationsDropdown');
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop';
    document.body.appendChild(backdrop);

    dropdownToggle.addEventListener('click', function() {
        const dropdownMenu = this.nextElementSibling;
        if (dropdownMenu.classList.contains('show')) {
            backdrop.style.display = 'block';
        } else {
            backdrop.style.display = 'none';
        }
    });

    backdrop.addEventListener('click', function() {
        const dropdownMenu = document.querySelector('.notifications-menu');
        dropdownMenu.classList.remove('show');
        this.style.display = 'none';
    });

    setInterval(function() {
        fetch('/notifications/get-latest')
            .then(response => response.json())
            .then(data => {
                updateNotificationCount(data.unreadCount);
                updateNotificationsList(data.notifications);
            });
    }, 30000);

    function updateNotificationCount(count) {
        const badge = document.querySelector('.notification-badge');
        if (count > 0) {
            if (!badge) {
                const newBadge = document.createElement('span');
                newBadge.className = 'notification-badge';
                newBadge.textContent = count;
                document.querySelector('#notificationsDropdown').appendChild(newBadge);
            } else {
                badge.textContent = count;
            }
        } else if (badge) {
            badge.remove();
        }
    }

    function updateNotificationsList(notifications) {
        const list = document.querySelector('.notifications-list');
        if (notifications.length === 0) {
            list.innerHTML = `
                <div class="text-center p-3">
                    <p class="mb-0">No notifications</p>
                </div>
            `;
            return;
        }

        list.innerHTML = notifications.map(notification => `
            <div class="notification-item ${notification.status === 'pending' ? 'unread' : ''}" 
                 data-id="${notification.id}">
                <p class="mb-1">${notification.message}</p>
                <small class="text-muted">${notification.created_at}</small>
            </div>
        `).join('');
    }
});
</script>
