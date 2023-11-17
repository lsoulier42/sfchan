<?php

namespace App\DataFixtures;

use App\Entity\Board;
use App\Entity\User;
use App\Enum\UserRoleEnum;
use App\Repository\BoardRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly string $adminPassword,
        private readonly UserRepository $userRepository,
        private readonly BoardRepository $boardRepository
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadBoards($manager);
        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager): void
    {
        $usersData = [[
            'admin',
            'admin@test.com',
            $this->adminPassword,
            UserRoleEnum::ROLE_ADMIN,
            true
        ]];
        foreach ($usersData as $userData) {
            $user = new User();
            $user->setUsername($userData[0])
                ->setEmail($userData[1])
                ->setPlainPassword($userData[2])
                ->addRole($userData[3])
                ->setEnabled($userData[4]);
            $this->userRepository->createOrUpdate($user, false);
        }
    }

    public function loadBoards(ObjectManager $manager): void
    {
        $boardsData = ["Anime & Manga" => "a",
            "Anime/Cute" => "c",
            "Anime/Wallpapers" => "w",
            "Mecha" => "m",
            "Cosplay & EGL" => "cgl",
            "Cute/Male" => "cm",
            "Flash" => "f",
            "Transportation" => "n",
            "Otaku Culture" => "jp",
            "Virtual YouTubers" => "vt",
            "Video Games" => "v",
            "Video Game Generals" => "vg",
            "Video Games/Multiplayer" => "vm",
            "Video Games/Mobile" => "vmg",
            "Pokémon" => "vp",
            "Retro Games" => "vr",
            "Video Games/RPG" => "vrpg",
            "Video Games/Strategy" => "vst",
            "Comics & Cartoons" => "co",
            "Technology" => "g",
            "Television & Film" => "tv",
            "Weapons" => "k",
            "Auto" => "o",
            "Animals & Nature" => "an",
            "Traditional Games" => "tg",
            "Sports" => "sp",
            "Extreme Sports" => "xs",
            "Professional Wrestling" => "pw",
            "Science & Math" => "sci",
            "History & Humanities" => "his",
            "International" => "int",
            "Outdoors" => "out",
            "Toys" => "toy",
            "Oekaki" => "i",
            "Papercraft & Origami" => "po",
            "Photography" => "p",
            "Food & Cooking" => "ck",
            "Artwork/Critique" => "ic",
            "Wallpapers/General" => "wg",
            "Literature" => "lit",
            "Music" => "mu",
            "Fashion" => "fa",
            "3DCG" => "3",
            "Graphic Design" => "gd",
            "Do-It-Yourself" => "diy",
            "Worksafe GIF" => "wsg",
            "Quests" => "qst",
            "Business & Finance" => "biz",
            "Travel" => "trv",
            "Fitness" => "fit",
            "Paranormal" => "x",
            "Advice" => "adv",
            "LGBT" => "lgbt",
            "Pony" => "mlp",
            "Current News" => "news",
            "Worksafe Requests" => "wsr",
            "Very Important Posts" => "vip",
            "Random" => "b",
            "ROBOT9001" => "r9k",
            "Politically Incorrect" => "pol",
            "International/Random" => "bant",
            "Cams & Meetups" => "soc",
            "Shit 4chan Says" => "s4s",
            "Sexy Beautiful Women" => "s",
            "Hardcore" => "hc",
            "Handsome Men" => "hm",
            "Hentai" => "h",
            "Ecchi" => "e",
            "Yuri" => "u",
            "Hentai/Alternative" => "d",
            "Yaoi" => "y",
            "Torrents" => "t",
            "High Resolution" => "hr",
            "Adult GIF" => "gif",
            "Adult Cartoons" => "aco",
            "Adult Requests" => "r"
        ];
        foreach ($boardsData as $description => $title) {
            $this->boardRepository->createOrUpdate(
                (new Board())->setTitle($title)->setDescription($description),
                false
            );
        }
    }
}
