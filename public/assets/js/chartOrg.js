//JavaScript
let options = getOptions();
let chart = new OrgChart(document.getElementById("tree"), {
    enableSearch: false,
    enableDragDrop: true,
    mouseScrool: OrgChart.none,
    scaleInitial: options.scaleInitial,
    tags: {
        "assistant": {
            template: "ula"
        }
    },
    nodeMenu: {
        details: {
            text: "Details"
        },
        edit: {
            text: "Edit"
        },
        add: {
            text: "Add"
        },
        remove: {
            text: "Remove"
        }
    },
    nodeBinding: {
        field_0: "name",
        field_1: "title",
        img_0: "img"
    }
});

chart.load([{
        id: 1,
        name: "Denny Curtis",
        title: "KETUA KEAMANAN",
        img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/460350274_1059658242828101_4454312353352678638_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=100&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeEf3q0LDDxfgiYxtUE2PauUeXR51yczcX95dHnXJzNxfz8vjP9DHiYSXqbPgn5KSl7WxBf3Xhr08a1pyWv2Rc3j&_nc_ohc=z7_5J-oiRDMQ7kNvgGOjNDi&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=AqP0mY_GNysExdTHPvC9Oyl&oh=00_AYD2d_BRjR9HSeiNwekX7-F2QCJUeCY-8m1JoEcXPyIorg&oe=675CB62B"
    },
    {
        id: 2,
        pid: 1,
        name: "Ashley Barnett",
        title: "Sales Manager",
        img: "https://cdn.balkan.app/shared/3.jpg"
    },
    {
        id: 3,
        pid: 1,
        name: "Caden Ellison",
        title: "Dev Manager",
        img: "https://cdn.balkan.app/shared/4.jpg"
    },
    {
        id: 4,
        pid: 2,
        name: "Elliot Patel",
        title: "Sales",
        img: "https://cdn.balkan.app/shared/5.jpg"
    },
    {
        id: 5,
        pid: 2,
        name: "Lynn Hussain",
        title: "Sales",
        img: "https://cdn.balkan.app/shared/6.jpg"
    },
    {
        id: 6,
        pid: 3,
        name: "Tanner May",
        title: "Developer",
        img: "https://cdn.balkan.app/shared/7.jpg"
    },
    {
        id: 8,
        pid: 1,
        tags: ["assistant"],
        name: "Rudy Griffiths",
        title: "Assistant",
        img: "https://cdn.balkan.app/shared/9.jpg"
    },
]);

function getOptions() {
    const searchParams = new URLSearchParams(window.location.search);
    let fit = searchParams.get('fit');
    let scaleInitial = 1;
    if (fit == 'yes') {
        scaleInitial = OrgChart.match.boundary;
    }
    return {
        scaleInitial
    };
}
