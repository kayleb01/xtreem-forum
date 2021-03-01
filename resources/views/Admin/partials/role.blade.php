<b>Primary Role:</b> @if($data[0]->role == 1) <span>Admin</span>
                      @elseif($data[0]->role == 2) <span>Moderator</span>
                      @else <span>User</span>
                      @endif