//JavaScript

OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.ana);
OrgChart.templates.myTemplate.size = [300, 80];
OrgChart.templates.myTemplate.node =
    `<rect x="0" y="0" height="80" width="300" fill="#fcc89b" rx="15" ry="15"></rect>
    <rect x="0" y="40" height="40" width="300" fill="#cc9d80" rx="15" ry="15"></rect>
    <rect x="0" y="40" height="20" width="300" fill="#cc9d80"></rect>
    <circle cx="35" cy="40" r="47" fill="#d1d2d4" stroke="#fff" stroke-width="5"></circle>
    <circle stroke="#939598" stroke-width="2" fill="#939598" cx="35" cy="25" r="8"></circle>
    <path d="M20,54 C20,32 50,32 50,54 L19,54" stroke="#939598" stroke-width="2" fill="#939598"></path>`;

OrgChart.templates.myTemplate.ripple = {
    radius: 15,
    color: "#0890D3",
    rect: { x: 0, y: 0, width: 300, height: 80, rx: 15, ry: 15 }
};

OrgChart.templates.myTemplate.field_0 =
    `<text width="210" class="field_0" style="font-size: 18px;" font-weight="bold" fill="#322b28" x="170" y="25" text-anchor="middle">{val}</text>`;
OrgChart.templates.myTemplate.field_1 =
    `<text width="210" class="field_1" style="font-size: 14px;" font-weight="bold" fill="#231f20" x="170" y="60" text-anchor="middle">{val}</text>`;
OrgChart.templates.myTemplate.img_0 =
    `<clipPath id="{randId}"><circle cx="35" cy="40" r="46"></circle></clipPath>
    <image preserveAspectRatio="xMidYMid slice" clip-path="url(#{randId})" xlink:href="{val}" x="-15" y="-10"  width="100" height="100"></image>`;

let options = getOptions();
let chart = new OrgChart(document.getElementById("tree"), {
    scaleInitial: options.scaleInitial,
    mouseScrool: OrgChart.action.none,
    enableSearch: false,
    template: "myTemplate",
    enableDragDrop: true,
    nodeBinding: {
        field_0: "name",
        field_1: "title",
        img_0: "img"
    },

});

let nodes = [
    { id: 1, name: "KH. ROGHIB MABRUR", title: "PENGASUH", img:"https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/457156175_1044663217660937_2673619720212197557_n.jpg?stp=dst-jpg_s600x600_tt6&_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeEWZF8WhrmCLGJPZpN272XxuXtkzyx10WK5e2TPLHXRYvFaCHg2qaO4nu_oVmEs41YuAl7y9wNgD22RSAnneUvO&_nc_ohc=M9uzX-nuBKUQ7kNvgGhx_w5&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=AUT_mW_mwB7EYjfpj-ZcBwu&oh=00_AYAeeXZau7YxwkkuBsMSXr_kAZu9GRQ8onkTMlPERtKVig&oe=675CEB04" },
    { id: 2, pid: 1, name: "BAHA'UDIN ", title: "KETUA PONDOK", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/438241644_961411055986154_2885372270462340155_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFqGoyMCr9XGL8012RyFfoBoWZHUQO-vY2hZkdRA769jTL55x72bkFWOK4AVQ-cjDBJrI85ftiDOe-yRa-3KyLd&_nc_ohc=Y4lUZtWsSDEQ7kNvgEe5xaW&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=AZZE5IAsimFhnvRRVYgpvoL&oh=00_AYD6DG5c85JAQhUc57b3Pw8uN1zAzEJcrLDVyfSyP_yH7g&oe=675CD892" },
    { id: 3, pid: 1, name: "adine bahak", title: "WAKIL KETUA PONDOK", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/420186885_886554713471789_6967762286042529651_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeHuuluKr3ciqGxzjtevS46DsiTZF9b4RfCyJNkX1vhF8CaOcPsuZg9ltzVIxJOsxWldlHyG_KDUDsyfccQ_yaMu&_nc_ohc=e2H7lXdoEAsQ7kNvgFDpQt-&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=ALqePPS4hQuIl07p3YSOAX1&oh=00_AYBOvve1XkXaK2vZgu6l374rZUHM5xGMf2oPZj53qNA9hA&oe=675CFA81" },
    { id: 4, pid: 2, name: "KANG A", title: "SEKRETARIS", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },
    { id: 5, pid: 2, name: "KANG B", title: "BENDAHARA", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },
    { id: 6, pid: 2, name: "FULAN", title: "MA'ARIF", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },
    { id: 7, pid: 2, name: "FULAN", title: "KETUA KEAMANAN", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },
    { id: 8, pid: 7, name: "FULAN", title: "WAKIL KEAMANAN", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },
    { id: 9, pid: 6, name: "FULAN", title: "WAKIL MA'ARIF", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },
    { id: 10, pid: 5, name: "FULAN", title: "WAKIL BENDAHARA", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },
    { id: 11, pid: 4, name: "FULAN", title: "WAKIL SEKRETARIS", img: "https://scontent.fcgk41-1.fna.fbcdn.net/v/t39.30808-6/445459858_983853817075211_4710021479981150668_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFRwXwtEWgA5x6kGsQ42oXZGEZQQmGpDpwYRlBCYakOnCd-WAFHhtUrXZ-D2lLGT6tH0VXc_RVHpACaC4WgB6hU&_nc_ohc=4LezrlBvl6UQ7kNvgHUdyT9&_nc_zt=23&_nc_ht=scontent.fcgk41-1.fna&_nc_gid=APTnY6DERhlREIU4J-WRsYH&oh=00_AYDDIz6AEXxgl3pSWHGzEUHalpuXuODCAjxGuzHYCmMWiQ&oe=675CE447" },

];

chart.load(nodes);

function getOptions(){
    const searchParams = new URLSearchParams(window.location.search);
    let fit = searchParams.get('fit');
    let scaleInitial = 1;
    if (fit == 'yes'){
        scaleInitial = OrgChart.match.boundary;
    }
    return {scaleInitial};
}
