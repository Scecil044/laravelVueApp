const adminMenus =[
    {
        name: "Dashboard",
        icon: "pi pi-home",
        to: "/app"
    },
    {
        name: "Users",
        icon: "pi pi-users",
        to: "/app/users"
    },
    {
        name: "Roles",
        icon: "pi pi-shield",
        to: "/app/roles"
    },
    {
        name: "Permissions",
        icon: "pi pi-lock",
        to: "/app/permissions"
    },
    {
        name: "Reports",
        icon: "pi pi-chart-line",
        to: "/app/reports"
    },
    {
        name: "Settings",
        icon: "pi pi-cog",
        to: "/app/settings"
    },
    {
        name: "Notifications",
        icon: "pi pi-bell",
        to: "/app/notifications"
    },
    {
        name: "Support",
        icon: "pi pi-question-circle",
        to: "/app/support"
    },
    {
        name: "HR",
        icon: "pi pi-users",
        chevron: true,
        children: [
            {
                name: "Requests",
                icon: "pi pi-paper-plane",
                to: "/app/requests"
            },
            {
                name: "Payroll",
                icon: "pi pi-dollar-sign",
                to: "/app/payroll"
            }
        ]
    },
    {
        name: "Configurations",
        icon: "pi pi-sliders-h",
        chevron: true,
        children: [
            {
                name: "System Configurations",
                icon: "pi pi-cog",
                to: "/app/configurations/system"
            },
            {
                name: "Roles & Permissions",
                icon: "pi pi-users",
                to: "/app/configurations/roles-permissions"
            }
        ]
    },
]

export {adminMenus }