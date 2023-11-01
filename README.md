- app types
    - app type projects
      - app type project menus
      - app type project permissions
    - app type rbac roles
      - rbac role -> app type project menus
      - rbac role -> app type project permissions

- app type projects

- app type project menus

- app type project permissions

- app type rbac roles

- app type rbac role menus

- app type rbac role permissions

- app projects
    - app_id             |       |  acss
    - app                |  -->  |  conference
    - app type project   |       |  ...

- acss                   
  - id                   |       |
  - app type id          |  -->  | 获取 已开通 project 
  - ...                  |       | 获取role --> 通过project获取 --> permission, menus

- acss user
  - acss id
  - user id
  - role value

- conference
  - id                   |       |
  - acss id              |  -->  | 获取 已开通 project
  - app type id          |       | 获取role --> 通过project获取 --> permission, menus
  - ...                  |       |

- conference staff
  - role value



# 用户登录
