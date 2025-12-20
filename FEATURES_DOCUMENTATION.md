# ASETIK V3 - Complete Separation of Admin and User Features

## Overview
The system is now completely separated between **Admin** and **Normal User** functionalities with different routes, controllers, and views.

---

## ADMIN FEATURES (Full Access)

### Routes Prefix: `/admin`
All admin routes use the `admin.` prefix (e.g., `admin.users.index`)

### 1. **Users Management**
- **View all users**: `/admin/users` → `admin.users.index`
- **Create user**: `/admin/users/create` → `admin.users.create`
- **View user details**: `/admin/users/{id}` → `admin.users.show`
- **Edit user**: `/admin/users/{id}/edit` → `admin.users.edit`
- **Delete user**: DELETE `/admin/users/{id}` → `admin.users.destroy`

### 2. **Products Management**
- **View all products**: `/admin/products` → `admin.products.index`
- **Create product**: `/admin/products/create` → `admin.products.create`
- **View product details**: `/admin/products/{id}` → `admin.products.show`
- **Edit product**: `/admin/products/{id}/edit` → `admin.products.edit`
- **Delete product**: DELETE `/admin/products/{id}` → `admin.products.destroy`

### 3. **Records Management** (Assign items to users)
- **View all records**: `/admin/records` → `admin.records.index`
- **Create record**: `/admin/records/create` → `admin.records.create`
- **View record details**: `/admin/records/{id}` → `admin.records.show`
- **Edit record**: `/admin/records/{id}/edit` → `admin.records.edit`
- **Delete record**: DELETE `/admin/records/{id}` → `admin.records.destroy`

### 4. **Repairs Management** (Approve/Manage repairs)
- **View all repair requests**: `/admin/repairs` → `admin.repairs.index`
- **View repair details**: `/admin/repairs/{id}` → `admin.repairs.show`
- **Edit repair**: `/admin/repairs/{id}/edit` → `admin.repairs.edit`
- **Delete repair**: DELETE `/admin/repairs/{id}` → `admin.repairs.destroy`

### Admin Navbar
- Dashboard
- Users
- Products
- Record
- Approve (Repairs)

---

## NORMAL USER FEATURES (Limited Access)

### Routes Prefix: `/user`
All user routes use the `user.` prefix (e.g., `user.profile`)

### 1. **Profile & Data**
- **View personal data and assigned items**: `/user/profile` → `user.profile`
  - Shows user information (name, age, email, division, badge, photo)
  - Shows all items/equipment assigned to this user
  - Has "Change Password" button

- **Change password**: `/user/profile/change-password` → `user.profile.change-password`
  - Form to change password (requires current password)

### 2. **Repair Requests**
- **Apply for repair** (broken items): `/user/repair/apply` → `user.repair.apply`
  - Shows all broken items owned by the user
  - User can submit repair request with notes
  - Changes item status to "pending"

- **Pickup repaired items**: `/user/repair/pickup` → `user.repair.pickup`
  - Shows items that are being repaired or ready for pickup
  - Status: "fixing" or "good"

### User Navbar (Blue Sidebar)
- Home (Dashboard)
- Show Data (Profile)
- Apply for Repair
- Pick Up Repair
- Logout

---

## Controllers Structure

### Admin Controllers (Existing)
- `UserController` - Manages all users
- `ProductController` - Manages all products
- `RecordController` - Manages all records (item assignments)
- `RepairController` - Manages all repair requests

### User Controllers (New)
- `App\Http\Controllers\User\ProfileController`
  - `index()` - Show user data and their items
  - `editPassword()` - Show change password form
  - `updatePassword()` - Update password

- `App\Http\Controllers\User\RepairController`
  - `applyIndex()` - Show broken items
  - `applyStore()` - Submit repair request
  - `pickupIndex()` - Show items ready for pickup

---

## Views Structure

### Admin Views
- `resources/views/admin/dashboard.blade.php`
- `resources/views/users/*` (all CRUD views)
- `resources/views/products/*` (all CRUD views)
- `resources/views/records/*` (all CRUD views)
- `resources/views/repairs/*` (all CRUD views)

### User Views
- `resources/views/user/dashboard.blade.php`
- `resources/views/user/profile/index.blade.php` (Show Data)
- `resources/views/user/profile/change-password.blade.php`
- `resources/views/user/repair/apply.blade.php` (Apply for Repair)
- `resources/views/user/repair/pickup.blade.php` (Pickup Repair)

---

## Key Differences

| Feature | Admin | Normal User |
|---------|-------|-------------|
| **Access Level** | Full CRUD on all resources | View own data only |
| **Users** | Manage all users | View own profile, change password |
| **Products** | Full CRUD | Cannot access |
| **Records** | Assign items to users | View items assigned to them |
| **Repairs** | Approve/manage all repairs | Apply for repair, pickup repaired items |
| **Routes** | `/admin/*` | `/user/*` |
| **Navbar** | Purple gradient (top) | Blue gradient (sidebar) |

---

## Workflow Example

### Normal User Workflow:
1. **Login** → Redirected to dashboard
2. **View Data** → See personal info and assigned items (status: good)
3. **Need repair** → Go to "Apply for Repair" (shows items with status "good")
4. **Submit repair request** → Item status changes from "good" to "broken"
5. **Admin reviews** → Admin sees the repair request in "Approve" section
6. **Admin starts repair** → Item status changes to "fixing"
7. **Admin completes** → Item status changes to "good"
8. **User picks up** → Go to "Pickup Repair" to see items ready for pickup

### Admin Workflow:
1. **Login** → Redirected to dashboard
2. **Manage Users** → Add/edit/delete users
3. **Manage Products** → Add/edit/delete products
4. **Assign Items** → Create records (assign products to users with status "good")
5. **Approve Repairs** → View repair requests (items with status "broken")
6. **Start Repair** → Change status to "fixing"
7. **Complete Repairs** → Change status to "good" when done

---

## Status Flow for Items

```
good → (user requests repair) → broken → (admin starts) → fixing → (admin completes) → good
```

- **good**: Item is working fine, assigned to user
- **broken**: User has requested repair (waiting for admin to start)
- **fixing**: Admin is currently repairing the item
- **good**: Item is repaired and ready for pickup

### Key Points:
- Users can only send items with **"good"** status for repair
- When user submits repair request, status automatically changes to **"broken"**
- Admin can see all items with "broken" status in the Approve section
- Admin changes status to "fixing" when starting repair
- Admin changes status to "good" when repair is complete
- Users can pickup items when status is "good" (in Pickup Repair section)

---

## Security

- All admin routes protected by `auth` and `admin` middleware
- All user routes protected by `auth` middleware
- Users can only see/modify their own data
- Admins have full access to all resources
