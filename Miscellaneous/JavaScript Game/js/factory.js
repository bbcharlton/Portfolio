class GameFactory {
	static createObject(str) {
		if (str == "Apple") {
			return new Apple(GameFactory.images[2]);
		}
	}
}

GameFactory.images = [];