<a href="{{ route('binary.tree.index', ['user_id' => $user->id]) }}" class="node-item">
    <img src="{{ $user->profile_image }}" alt="{{ $user->name }}">
    <div class="fw-bold text-dark" style="font-size: 12px;">{{ Str::limit($user->name, 15) }}</div>
    <div class="text-primary small mb-1">{{ $user->member_id }}</div>
    
    <div class="d-flex justify-content-between border-top pt-1 mt-1" style="font-size: 10px;">
        <span class="text-success">L: {{ $user->binaryTree->left_count ?? 0 }}</span>
        <span class="text-danger">R: {{ $user->binaryTree->right_count ?? 0 }}</span>
    </div>
</a>

@if($level < $maxLevel)
    @php
        // Look for children in the downline collection
        $left = $downline->where('parent_id', $user->id)->where('position', 'left')->first();
        $right = $downline->where('parent_id', $user->id)->where('position', 'right')->first();
    @endphp

    @if($left || $right)
        <ul>
            <li>
                @if($left && $left->user)
                    @include('backend.partials.tree_node', [
                        'user' => $left->user, 
                        'level' => $level + 1, 
                        'maxLevel' => $maxLevel,
                        'downline' => $downline // Pass downline to sub-levels
                    ])
                @else
                    <div class="empty-node">Empty Left</div>
                @endif
            </li>
            <li>
                @if($right && $right->user)
                    @include('backend.partials.tree_node', [
                        'user' => $right->user, 
                        'level' => $level + 1, 
                        'maxLevel' => $maxLevel,
                        'downline' => $downline // Pass downline to sub-levels
                    ])
                @else
                    <div class="empty-node">Empty Right</div>
                @endif
            </li>
        </ul>
    @endif
@endif