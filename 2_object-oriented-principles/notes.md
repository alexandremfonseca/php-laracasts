# 1. Object-Oriented Principles

## 1.1. Classes
    
### 1.1.1. Concrete Classes
    class Team
    {
        protected $name;

        protected $members = [];

        public function __construct($name, $members = [])
        {
            $this->name = $name;
            $this->members = $members;
        }

        public static function start(...$params)
        {
            return new static(...$params);
        }

        public function name()
        {
            return $this->name;
        }

        public function members()
        {
            return $this->members;
        }

        public function add($name)
        {
            $this->members[] = $name;
        }
    }

    class Member
    {
        protected $name;

        public function __construct($name)
        {
            $this->name = $name;
        }
    }

### 1.1.2. Abstract Classes
    abstract class AchievementType
    {
        public function name()
        {
            $class = (new ReflectionClass($this))->getShortName();

            return trim(preg_replace('/[A-Z]/', ' $0', $class));
        }

        public function icon()
        {
            return strtolower(str_replace(' ', '-', $this->name())) . '.png';
        }

        abstract public function qualifier($user);
    }

    class FirstThousandPoints extends AchievementType
    {
        public function qualifier($user)
        {
            return 'You are qualified!';
        }
    }

### 1.1.3. Interfaces
    interface Newsletter
    {
        public function subscribe($email);
    }

    class CampaignMonitor implements Newsletter
    {
        public function subscribe($email)
        {
            die('Subscribing with Campaign Monitor!');
        }
    }

    class Drip implements Newsletter
    {
        public function subscribe($email)
        {
            die('Subscribing with Drip!');
        }
    }

    class NewsletterSubscriptionController
    {
        public function store(Newsletter $newsletter)
        {
            $email = 'joe@example.com';

            $newsletter->subscribe($email);
        }
    }

    $controller = new NewsletterSubscriptionController();

    $controller->store(new CampaignMonitor());

## 1.2. Objects

### 1.2.1. Constructor
    $acme = new Team('Acme', [
        new Member('John Doe'),
        new Member('Jane Doe')
    ]);

### 1.2.2. Static
    $acme = Team::start('Acme', [
        new Member('John Doe'),
        new Member('Jane Doe')
    ]);

### 1.2.3. Value Objects
    class Age
    {
        protected $age;

        public function __construct($age)
        {
            if ($age < 0 || $age > 120) {
                throw new InvalidArgumentException('That makes no sense!');
            }

            $this->age = $age;
        }
    }

    $age = new Age(35);
    var_dump($age);

## 1.3. Inheritance
    class Collection
    {
        protected array $items;

        public function __construct($items)
        {
            $this->items = $items;
        }

        public function sum($key)
        {
            return array_sum(array_column($this->items, $key));
        }
    }

    class VideosCollection extends Collection
    {
        public function length()
        {
            return $this->sum('length');
        }
    }

    class Video
    {
        public $title;
        public $length;

        public function __construct($title, $length)
        {
            $this->title = $title;
            $this->length = $length;
        }
    }

    $videos = new VideosCollection([
        new Video('Some Video', 100),
        new Video('Some Video 2', 200),
        new Video('Some Video 3', 300)
    ]);

    echo $videos->length();

## 1.4. Encapsulation
    class TennisMatch
    {
        public function score()
        {
            //
        }

        protected function hasWinner()
        {
            //
        }

        private function hasAdvantage()
        {
            //
        }
    }

## 1.5. Exceptions
    class TeamException extends Exception
    {
        public static function fromTooManyMembers()
        {
            return new static('You may not add more than 3 members!');
        }
    }

    class Member
    {
        public $name;

        public function __construct($name)
        {
            $this->name = $name;
        }
    }

    class Team
    {
        protected $members = [];

        public function add(Member $member)
        {
            if (count($this->members) === 3) {
                throw TeamException::fromTooManyMembers();
            }

            $this->members[] = $member;
        }

        public function members()
        {
            return $this->members;
        }
    }

    $team = new Team;

    $team->add(new Member('Jane Doe'));
    $team->add(new Member('John Doe'));
    $team->add(new Member('Frank Doe'));
    $team->add(new Member('Susan Doe'));

    var_dump($team->members());
